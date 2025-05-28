<div class="search-form">
    <form action="{{ route('courses.search') }}" method="GET" class="row g-3">
        <div class="col-md-{{ $expandSearch ?? false ? '12' : '8' }}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm khóa học, kỹ năng..." name="search" value="{{ $searchTerm ?? request('search') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search me-1"></i> Tìm kiếm
                </button>
            </div>
        </div>
        
        @if($showFilters ?? true)
            <div class="col-md-4 d-flex gap-2">
                @if(isset($filters) && in_array('category', $filters))
                    <select name="category" class="form-select">
                        <option value="">Tất cả danh mục</option>
                        <option value="lap-trinh" {{ request('category') == 'lap-trinh' ? 'selected' : '' }}>Lập trình</option>
                        <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="thiet-ke" {{ request('category') == 'thiet-ke' ? 'selected' : '' }}>Thiết kế</option>
                        <option value="kinh-doanh" {{ request('category') == 'kinh-doanh' ? 'selected' : '' }}>Kinh doanh</option>
                        <option value="ngoai-ngu" {{ request('category') == 'ngoai-ngu' ? 'selected' : '' }}>Ngoại ngữ</option>
                    </select>
                @endif
                
                @if(isset($filters) && in_array('sort', $filters))
                    <select name="sort" class="form-select">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
                    </select>
                @endif
            </div>
        @endif
        
        @if($showAdvanced ?? false)
            <div class="col-12 mt-3">
                <div class="accordion" id="searchFiltersAccordion">
                    <div class="accordion-item border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingAdvanced">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapseAdvanced" aria-expanded="false" aria-controls="collapseAdvanced">
                                Bộ lọc nâng cao
                            </button>
                        </h2>
                        <div id="collapseAdvanced" class="accordion-collapse collapse" aria-labelledby="headingAdvanced">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Cấp độ</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="level" id="level-all" value="" 
                                                       {{ request('level') == '' || !request('level') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="level-all">Tất cả</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="level" id="level-beginner" 
                                                       value="beginner" {{ request('level') == 'beginner' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="level-beginner">Cơ bản</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="level" id="level-intermediate" 
                                                       value="intermediate" {{ request('level') == 'intermediate' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="level-intermediate">Trung cấp</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="level" id="level-advanced" 
                                                       value="advanced" {{ request('level') == 'advanced' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="level-advanced">Nâng cao</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Áp dụng bộ lọc</button>
                                        <a href="{{ route('courses.search') }}" class="btn btn-outline-secondary ms-2">Xóa bộ lọc</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div> 