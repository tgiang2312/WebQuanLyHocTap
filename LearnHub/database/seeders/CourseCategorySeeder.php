<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the main categories and their subcategories
        $categories = [
            'Lập trình' => [
                'Lập trình Web',
                'Lập trình Mobile',
                'Trí tuệ nhân tạo',
                'Cơ sở dữ liệu',
                'Bảo mật'
            ],
            'Marketing' => [
                'Digital Marketing',
                'Social Media Marketing',
                'Content Marketing',
                'SEO',
                'Email Marketing'
            ],
            'Thiết kế' => [
                'UI/UX Design',
                'Thiết kế đồ họa',
                'Thiết kế Web',
                'Thiết kế 3D',
                'Animation'
            ],
            'Kinh doanh' => [
                'Khởi nghiệp',
                'Tài chính',
                'Quản lý',
                'Bán hàng',
                'Thương mại điện tử'
            ],
            'Ngoại ngữ' => [
                'Tiếng Anh',
                'Tiếng Nhật',
                'Tiếng Hàn',
                'Tiếng Trung',
                'Tiếng Pháp'
            ]
        ];
        
        // Get all existing courses
        $courses = Course::all();
        
        // Map old categories to new ones
        $categoryMapping = [
            'web' => ['category' => 'Lập trình', 'subcategory' => 'Lập trình Web'],
            'mobile' => ['category' => 'Lập trình', 'subcategory' => 'Lập trình Mobile'],
            'database' => ['category' => 'Lập trình', 'subcategory' => 'Cơ sở dữ liệu'],
            'design' => ['category' => 'Thiết kế', 'subcategory' => 'UI/UX Design'],
            'ai' => ['category' => 'Lập trình', 'subcategory' => 'Trí tuệ nhân tạo'],
            'network' => ['category' => 'Lập trình', 'subcategory' => 'Bảo mật'],
            'security' => ['category' => 'Lập trình', 'subcategory' => 'Bảo mật'],
            'other' => ['category' => 'Lập trình', 'subcategory' => 'Lập trình Web']
        ];
        
        // Update each course with proper category and subcategory
        foreach ($courses as $course) {
            $oldCategory = $course->category;
            
            // If the course already has a new category format, skip it
            if (array_key_exists($oldCategory, $categories)) {
                continue;
            }
            
            // Map old category to new category and subcategory
            if (array_key_exists($oldCategory, $categoryMapping)) {
                $newCategory = $categoryMapping[$oldCategory]['category'];
                $newSubcategory = $categoryMapping[$oldCategory]['subcategory'];
            } else {
                // Default category if mapping not found
                $newCategory = 'Lập trình';
                $newSubcategory = 'Lập trình Web';
            }
            
            // Update the course
            $course->category = $newCategory;
            $course->subcategory = $newSubcategory;
            $course->save();
            
            $this->command->info("Updated course '{$course->title}': {$oldCategory} -> {$newCategory} / {$newSubcategory}");
        }
        
        $this->command->info('Course categories and subcategories have been updated successfully!');
    }
}
