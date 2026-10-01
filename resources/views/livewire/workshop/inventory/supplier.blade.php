<div class="carnate-suppliers-page">
    <style>
        .carnate-suppliers-page { --sp-card:#fff; --sp-text:#111827; --sp-muted:#64748b; --sp-border:#e2e8f0; --sp-red:#e53935; --sp-red-soft:#fff5f5; color:var(--sp-text); }
        .carnate-suppliers-page *, .carnate-suppliers-page *::before, .carnate-suppliers-page *::after { box-sizing:border-box; }
        .carnate-suppliers-page .sp-page { padding:24px 0 28px; }
        .carnate-suppliers-page .sp-card { background:var(--sp-card); border:1px solid var(--sp-border); border-radius:16px; box-shadow:0 4px 16px rgba(15,23,42,.035); overflow:hidden; }
        .carnate-suppliers-page .sp-header { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px 22px; }
        .carnate-suppliers-page .sp-heading { display:flex; align-items:center; gap:13px; min-width:0; }
        .carnate-suppliers-page .sp-heading-icon { display:grid; place-items:center; width:44px; height:44px; flex:0 0 44px; border-radius:12px; color:var(--sp-red); background:var(--sp-red-soft); font-size:20px; }
        .carnate-suppliers-page .sp-title { margin:0; color:var(--sp-text); font-size:22px; font-weight:750; letter-spacing:-.02em; }
        .carnate-suppliers-page .sp-subtitle { margin:4px 0 0; color:var(--sp-muted); font-size:13px; }
        .carnate-suppliers-page .sp-add-btn, .carnate-suppliers-page .sp-save-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; min-height:42px; padding:0 17px; border:1px solid var(--sp-red); border-radius:10px; background:var(--sp-red); color:#fff !important; font-size:13px; font-weight:700; box-shadow:0 5px 14px rgba(229,57,53,.16); text-decoration:none; transition:all .2s ease; }
        .carnate-suppliers-page .sp-add-btn:hover, .carnate-suppliers-page .sp-save-btn:hover { background:#d93431; border-color:#d93431; color:#fff; transform:translateY(-1px); }
        .carnate-suppliers-page .sp-toolbar { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:16px 20px; }
        .carnate-suppliers-page .sp-search-wrap { position:relative; flex:1; max-width:460px; }
        .carnate-suppliers-page .sp-search-wrap i { position:absolute; top:50%; left:13px; transform:translateY(-50%); color:#94a3b8; font-size:17px; pointer-events:none; }
        .carnate-suppliers-page .form-control { min-height:42px; border:1px solid var(--sp-border); border-radius:9px; color:var(--sp-text); font-size:13px; box-shadow:none; }
        .carnate-suppliers-page .sp-search-wrap .form-control { padding-left:39px; }
        .carnate-suppliers-page .form-control:focus { border-color:rgba(229,57,53,.5); box-shadow:0 0 0 3px rgba(229,57,53,.08); }
        .carnate-suppliers-page .sp-clear-btn, .carnate-suppliers-page .sp-cancel-btn { min-height:40px; padding:0 15px; border:1px solid var(--sp-border); border-radius:9px; background:#fff; color:#475569; font-size:13px; font-weight:650; }
        .carnate-suppliers-page .sp-clear-btn:hover, .carnate-suppliers-page .sp-cancel-btn:hover { border-color:#cbd5e1; background:#f8fafc; }
        .carnate-suppliers-page .sp-table-card { margin-top:18px; }
        .carnate-suppliers-page .sp-table-header { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:18px 20px; border-bottom:1px solid var(--sp-border); }
        .carnate-suppliers-page .sp-table-title { margin:0; font-size:15px; font-weight:700; }
        .carnate-suppliers-page .sp-table-meta { margin:3px 0 0; color:var(--sp-muted); font-size:12px; }
        .carnate-suppliers-page .table-responsive { margin:0; }
        .carnate-suppliers-page .sp-table { margin:0; border:0; vertical-align:middle; }
        .carnate-suppliers-page .sp-table thead th { padding:13px 16px; border:0; border-bottom:1px solid var(--sp-border); background:#f8fafc; color:#475569; font-size:11px; font-weight:700; letter-spacing:.03em; text-transform:uppercase; white-space:nowrap; }
        .carnate-suppliers-page .sp-table tbody td { padding:14px 16px; border-color:var(--sp-border); color:#475569; font-size:13px; }
        .carnate-suppliers-page .sp-table tbody tr:hover td { background:#fcfcfd; }
        .carnate-suppliers-page .sp-company { color:#1e293b; font-weight:700; }
        .carnate-suppliers-page .sp-empty { padding:42px !important; color:var(--sp-muted) !important; }
        .carnate-suppliers-page .sp-action { display:inline-grid; place-items:center; width:32px; height:32px; margin-right:5px; padding:0; border:1px solid var(--sp-border); border-radius:8px; background:#fff; font-size:16px; }
        .carnate-suppliers-page .sp-action-edit { color:var(--sp-red); } .carnate-suppliers-page .sp-action-edit:hover { background:var(--sp-red-soft); border-color:#fecaca; }
        .carnate-suppliers-page .sp-action-delete { color:var(--sp-red); } .carnate-suppliers-page .sp-action-delete:hover { background:var(--sp-red-soft); border-color:#fecaca; }
        .carnate-suppliers-page .sp-pagination { margin-top:16px; }
        .carnate-suppliers-page .sp-pagination .pagination { gap:5px; margin:0; }
        .carnate-suppliers-page .sp-pagination .page-link { min-width:36px; min-height:36px; display:grid; place-items:center; padding:0 10px; border:1px solid var(--sp-border); border-radius:8px !important; background:#fff; color:#475569; font-size:13px; font-weight:650; box-shadow:none !important; }
        .carnate-suppliers-page .sp-pagination .page-link:hover { border-color:#fecaca; background:var(--sp-red-soft); color:var(--sp-red); }
        .carnate-suppliers-page .sp-pagination .page-item.active .page-link { border-color:var(--sp-red); background:var(--sp-red); color:#fff; }
        .carnate-suppliers-page .sp-pagination .page-item.disabled .page-link { background:#f8fafc; color:#cbd5e1; }
        /* Pace is loaded by the workshop layout; prevent its legacy Bootstrap-blue loader from appearing on this branded page. */
        body .pace .pace-progress { background:#e53935 !important; }
        body .pace .pace-progress-inner { box-shadow:0 0 10px #e53935, 0 0 5px #e53935 !important; }
        body .pace .pace-activity { border-top-color:#e53935 !important; border-left-color:#e53935 !important; }
        .carnate-suppliers-page .modal-content { border:0; border-radius:16px; box-shadow:0 20px 50px rgba(15,23,42,.18); overflow:hidden; }
        .carnate-suppliers-page .sp-modal-header { padding:18px 22px; border-bottom:1px solid var(--sp-border); }
        .carnate-suppliers-page .sp-modal-title { margin:0; font-size:18px; font-weight:700; color:var(--sp-text); }
        .carnate-suppliers-page .sp-modal-body { padding:22px; }
        .carnate-suppliers-page .sp-modal-section { margin:4px 0 17px; color:#334155; font-size:14px; font-weight:700; }
        .carnate-suppliers-page .sp-modal-divider { margin:20px 0; border-color:var(--sp-border); opacity:1; }
        .carnate-suppliers-page .form-label { margin-bottom:7px; color:#334155; font-size:12px; font-weight:650; }
        .carnate-suppliers-page .error { display:block; margin-top:5px; font-size:11px; } .carnate-suppliers-page .text-danger { color:var(--sp-red) !important; }
        .carnate-suppliers-page .sp-modal-footer { display:flex; justify-content:flex-end; gap:9px; padding:15px 22px; border-top:1px solid var(--sp-border); }
        @media (max-width:767px) { .carnate-suppliers-page .sp-page { padding-top:16px; } .carnate-suppliers-page .sp-header, .carnate-suppliers-page .sp-toolbar { align-items:stretch; flex-direction:column; } .carnate-suppliers-page .sp-add-btn, .carnate-suppliers-page .sp-clear-btn { width:100%; } .carnate-suppliers-page .sp-search-wrap { max-width:none; width:100%; } .carnate-suppliers-page .sp-header, .carnate-suppliers-page .sp-toolbar, .carnate-suppliers-page .sp-table-header { padding:17px; } }
    </style>

    <div class="sp-page">
        <section class="sp-card sp-header">
            <div class="sp-heading"><span class="sp-heading-icon"><i class="bx bx-store-alt"></i></span><div><h1 class="sp-title">Suppliers</h1><p class="sp-subtitle">Manage supplier contacts and business details</p></div></div>
            <button type="button" wire:click="openModal" class="sp-add-btn"><i class="bx bx-plus"></i> Add Supplier</button>
        </section>

        <section class="sp-card mt-3"><div class="sp-toolbar"><div class="sp-search-wrap"><i class="bx bx-search"></i><input type="text" wire:model.live="search" class="form-control" placeholder="Search company, supplier, or mobile number"></div><button type="button" class="sp-clear-btn" wire:click="clearSearch">Clear filters</button></div></section>

        <div class="modal @if ($showModal) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; @if ($showModal) display:block; @else display:none; @endif">
            <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content"><form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="sp-modal-header d-flex justify-content-between align-items-center"><h4 class="sp-modal-title">{{ $isEdit ? 'Edit Supplier' : 'Add Supplier' }}</h4><button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="sp-modal-body">
                    <div class="row g-3"><div class="col-md-6"><label class="form-label">Mobile No.<span class="text-danger">*</span></label><input type="text" wire:model.lazy="mobile_no" class="form-control" placeholder="Enter mobile number">@error('mobile_no') <span class="text-danger error">{{ $message }}</span> @enderror</div></div>
                    <hr class="sp-modal-divider"><h5 class="sp-modal-section">Business information</h5>
                    <div class="row g-3"><div class="col-md-4"><label class="form-label">Company Name <sup class="text-danger">*</sup></label><input type="text" wire:model="business_first_name" class="form-control" placeholder="Enter company name">@error('business_first_name') <span class="text-danger error">{{ $message }}</span> @enderror</div><div class="col-md-4"><label class="form-label">Address</label><input type="text" wire:model="business_address" class="form-control" placeholder="Enter address">@error('business_address') <span class="text-danger error">{{ $message }}</span> @enderror</div><div class="col-md-4"><label class="form-label">GSTIN</label><input type="text" wire:model="gstin" class="form-control" placeholder="Enter GSTIN">@error('gstin') <span class="text-danger error">{{ $message }}</span> @enderror</div></div>
                    <hr class="sp-modal-divider"><h5 class="sp-modal-section">Owner information</h5>
                    <div class="row g-3"><div class="col-md-4"><label class="form-label">Supplier Name <sup class="text-danger">*</sup></label><input type="text" wire:model="owner_first_name" class="form-control" placeholder="Enter supplier name">@error('owner_first_name') <span class="text-danger error">{{ $message }}</span> @enderror</div><div class="col-md-4"><label class="form-label">Contact 1 <sup class="text-danger">*</sup></label><input type="text" wire:model="contact_1" class="form-control" placeholder="Enter contact number">@error('contact_1') <span class="text-danger error">{{ $message }}</span> @enderror</div><div class="col-md-4"><label class="form-label">Contact 2</label><input type="text" wire:model="contact_2" class="form-control" placeholder="Enter alternate contact">@error('contact_2') <span class="text-danger error">{{ $message }}</span> @enderror</div><div class="col-md-4"><label class="form-label">Email</label><input type="email" wire:model="email" class="form-control" placeholder="Enter email address">@error('email') <span class="text-danger error">{{ $message }}</span> @enderror</div></div>
                </div>
                <div class="sp-modal-footer"><button type="button" class="sp-cancel-btn" wire:click="closeModal" data-bs-dismiss="modal">Cancel</button><button type="submit" class="sp-save-btn">{{ $isEdit ? 'Update Supplier' : 'Save Supplier' }} <i class="spinner-border spinner-border-sm" wire:loading></i></button></div>
            </form></div></div>
        </div>

        <section class="sp-card sp-table-card">
            <div class="sp-table-header"><div><h2 class="sp-table-title">Supplier directory</h2><p class="sp-table-meta">View and maintain your supplier records</p></div></div>
            <div class="table-responsive"><table class="table sp-table"><thead><tr><th>Sr No.</th><th>Company Name</th><th>Supplier Name</th><th>Contact No.</th><th>Email</th><th>Address</th><th>GSTIN</th><th>Action</th></tr></thead><tbody>
                @forelse ($suppliers as $supplier)
                    <tr><td>{{ $loop->iteration + ($suppliers->firstItem() - 1) }}</td><td class="sp-company">{{ $supplier->business_first_name }}</td><td>{{ $supplier->owner_first_name }}</td><td>{{ $supplier->mobile_no }}</td><td>{{ $supplier->email ?: '—' }}</td><td>{{ $supplier->business_address ?: '—' }}</td><td>{{ $supplier->gstin ?: '—' }}</td><td class="text-nowrap"><button type="button" class="sp-action sp-action-edit" wire:click="edit({{ $supplier->id }})" title="Edit supplier" aria-label="Edit supplier"><i class="bx bxs-edit"></i></button><button type="button" class="sp-action sp-action-delete" wire:click="confirmDelete({{ $supplier->id }})" title="Delete supplier" aria-label="Delete supplier"><i class="bx bxs-trash"></i></button></td></tr>
                @empty
                    <tr><td colspan="8" class="text-center sp-empty">No suppliers found.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>
        <div class="sp-pagination">{{ $suppliers->links() }}</div>
    </div>
</div>
