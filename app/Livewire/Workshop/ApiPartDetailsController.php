<?php

namespace App\Livewire\Workshop;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class ApiPartDetailsController extends Component
{
    public $partNumber;
    public $article = null;
    public $loading = true;

    public function mount($number)
    {
        $this->partNumber = $number;
        $this->fetchDetails();
    }

    public function fetchDetails()
    {
        $this->loading = true;
        
        $cleanValue = preg_replace('/[^A-Za-z0-9]/', '', $this->partNumber);
        $found = false;
        $articleData = null;

        // Step 1: Try Original Search (Same as Sparepart/PartsController)
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
            'X-RapidAPI-Key' => config('services.rapidapi.key'),
        ])->get('https://auto-parts-catalog.p.rapidapi.com/articles/article-number-details/lang-id/4/country-filter-id/62/article-no/' . $this->partNumber);

        if ($response->successful() && !empty($response->json()['articles'])) {
            $articleData = $response->json()['articles'][0];
            $found = true;
        }

        // Step 2: Fallback to Cross-Number Search (ArticleNumber)
        if (!$found) {
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/ArticleNumber/article-no/' . $cleanValue);

            if ($response->successful() && !empty($response->json()['articles'])) {
                $articleData = $response->json()['articles'][0];
                $articleData['articleProductName'] = $articleData['articleProductName'] ?? null;
                $articleData['supplierName'] = $articleData['supplierName'] ?? null;
                $articleData['s3ImageLink'] = $articleData['s3image'] ?? null;
                $found = true;
            }
        }

        // Step 3: Fallback to OENumber
        if (!$found) {
            $response = Http::withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/OENumber/article-no/' . $cleanValue);

            if ($response->successful() && !empty($response->json()['articles'])) {
                $articleData = $response->json()['articles'][0];
                $articleData['articleProductName'] = $articleData['articleProductName'] ?? null;
                $articleData['supplierName'] = $articleData['supplierName'] ?? null;
                $articleData['s3ImageLink'] = $articleData['s3image'] ?? null;
                $found = true;
            }
        }

        $this->article = $articleData;
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.workshop.api-part-details-controller');
    }
}
