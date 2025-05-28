<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\CategoryHelper;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CategoryList extends Component
{
    /**
     * Kiểu hiển thị của danh mục
     */
    public $displayType;
    
    /**
     * Create a new component instance.
     */
    public function __construct($displayType = 'grid')
    {
        $this->displayType = $displayType;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $categories = CategoryHelper::getCategories();
        $categoryCounts = [];
        
        // Đếm số lượng khóa học trong mỗi danh mục
        foreach ($categories as $slug => $name) {
            $count = Course::where('category', $name)
                          ->where('status', 'published')
                          ->count();
            $categoryCounts[$slug] = $count;
        }
        
        // Tổng số khóa học
        $totalCourses = array_sum($categoryCounts);
        
        return view('components.category-list', [
            'categories' => $categories,
            'categoryCounts' => $categoryCounts,
            'totalCourses' => $totalCourses,
            'displayType' => $this->displayType
        ]);
    }
}
