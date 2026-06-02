<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SparePartCategoryService
{
    private const CACHE_KEY = 'sparepart_parent_category_names';

    private const CUSTOM_CACHE_KEY = 'sparepart_custom_parent_category_names';

    /**
     * Parent categories for dropdown (local DB ids). API parents + vendor-created parents.
     */
    public static function getDropdownCategories(): array
    {
        $roots = self::getRootNames();
        $query = Category::select('id as categoryId', 'title as categoryName')->orderBy('title');

        if (!empty($roots)) {
            $query->whereIn('title', $roots);
        }

        return $query->get()->toArray();
    }

    /**
     * Sync parent groups from API into DB (called from Parts / Category on mount).
     */
    public static function syncParentsFromApi(): array
    {
        try {
            $response = Http::timeout(15)->withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key'  => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/category/type-id/1/products-groups-variant-2/19942/lang-id/4');

            if ($response->successful() && !empty($response->json()['categories'])) {
                $roots = collect($response->json()['categories'])
                    ->pluck('categoryName')
                    ->map(fn ($name) => trim((string) $name))
                    ->filter()
                    ->values()
                    ->all();

                Cache::put(self::CACHE_KEY, $roots, now()->addDay());

                foreach ($roots as $name) {
                    Category::firstOrCreate(['title' => $name]);
                }

                return $roots;
            }
        } catch (\Exception $e) {
            Log::warning('SparePartCategoryService sync failed: ' . $e->getMessage());
        }

        return [];
    }

    /** API parent names + manually created parent names. */
    public static function getRootNames(): array
    {
        $api = Cache::get(self::CACHE_KEY);
        if (!is_array($api) || empty($api)) {
            $api = self::syncParentsFromApi();
        }

        $custom = Cache::get(self::CUSTOM_CACHE_KEY, []);
        if (!is_array($custom)) {
            $custom = [];
        }

        return array_values(array_unique(array_merge($api, $custom)));
    }

    /**
     * Register a vendor-created parent category (shows in list + all module dropdowns).
     */
    public static function addCustomParent(string $title): void
    {
        $title = trim($title);
        if ($title === '') {
            return;
        }

        Category::firstOrCreate(['title' => $title]);

        $custom = Cache::get(self::CUSTOM_CACHE_KEY, []);
        if (!is_array($custom)) {
            $custom = [];
        }

        if (!in_array($title, $custom, true)) {
            $custom[] = $title;
            Cache::put(self::CUSTOM_CACHE_KEY, $custom, now()->addYear());
        }
    }

    public static function removeCustomParent(string $title): void
    {
        $title = trim($title);
        $custom = Cache::get(self::CUSTOM_CACHE_KEY, []);

        if (!is_array($custom)) {
            return;
        }

        Cache::put(
            self::CUSTOM_CACHE_KEY,
            array_values(array_filter($custom, fn ($name) => $name !== $title)),
            now()->addYear()
        );
    }

    public static function renameCustomParent(string $oldTitle, string $newTitle): void
    {
        self::removeCustomParent($oldTitle);
        self::addCustomParent($newTitle);
    }

    public static function ensureCategoryInDropdown(array &$categories, int $categoryId): void
    {
        if ($categoryId <= 0) {
            return;
        }

        $exists = collect($categories)->contains(fn ($c) => (int) ($c['categoryId'] ?? 0) === $categoryId);
        if ($exists) {
            return;
        }

        $cat = Category::find($categoryId);
        if ($cat) {
            self::addCustomParent($cat->title);
            $categories[] = [
                'categoryId'   => $cat->id,
                'categoryName' => $cat->title,
            ];
        }
    }
}
