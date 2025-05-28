<?php

namespace App\Helpers;

class CategoryHelper
{
    /**
     * Get all main categories
     * 
     * @return array
     */
    public static function getCategories(): array
    {
        return [
            'lap-trinh' => 'Lập trình',
            'marketing' => 'Marketing',
            'thiet-ke' => 'Thiết kế',
            'kinh-doanh' => 'Kinh doanh',
            'ngoai-ngu' => 'Ngoại ngữ'
        ];
    }
    
    /**
     * Get all subcategories organized by main category
     * 
     * @return array
     */
    public static function getSubcategories(): array
    {
        return [
            'lap-trinh' => [
                'web' => 'Lập trình Web',
                'mobile' => 'Lập trình Mobile',
                'ai' => 'Trí tuệ nhân tạo',
                'database' => 'Cơ sở dữ liệu',
                'security' => 'Bảo mật'
            ],
            'marketing' => [
                'digital' => 'Digital Marketing',
                'social-media' => 'Social Media Marketing',
                'content' => 'Content Marketing',
                'seo' => 'SEO',
                'email' => 'Email Marketing'
            ],
            'thiet-ke' => [
                'ui-ux' => 'UI/UX Design',
                'graphic' => 'Thiết kế đồ họa',
                'web-design' => 'Thiết kế Web',
                '3d' => 'Thiết kế 3D',
                'animation' => 'Animation'
            ],
            'kinh-doanh' => [
                'startup' => 'Khởi nghiệp',
                'finance' => 'Tài chính',
                'management' => 'Quản lý',
                'sales' => 'Bán hàng',
                'ecommerce' => 'Thương mại điện tử'
            ],
            'ngoai-ngu' => [
                'english' => 'Tiếng Anh',
                'japanese' => 'Tiếng Nhật',
                'korean' => 'Tiếng Hàn',
                'chinese' => 'Tiếng Trung',
                'french' => 'Tiếng Pháp'
            ]
        ];
    }
    
    /**
     * Get category name by slug
     * 
     * @param string $slug
     * @return string|null
     */
    public static function getCategoryName(string $slug): ?string
    {
        return self::getCategories()[$slug] ?? null;
    }
    
    /**
     * Get subcategory name by category slug and subcategory slug
     * 
     * @param string $categorySlug
     * @param string $subcategorySlug
     * @return string|null
     */
    public static function getSubcategoryName(string $categorySlug, string $subcategorySlug): ?string
    {
        return self::getSubcategories()[$categorySlug][$subcategorySlug] ?? null;
    }
    
    /**
     * Get subcategories for a specific category
     * 
     * @param string $categorySlug
     * @return array
     */
    public static function getSubcategoriesForCategory(string $categorySlug): array
    {
        return self::getSubcategories()[$categorySlug] ?? [];
    }
    
    /**
     * Get category icon class
     * 
     * @param string $categorySlug
     * @return string
     */
    public static function getCategoryIcon(string $categorySlug): string
    {
        $icons = [
            'lap-trinh' => 'bi-code-square text-primary',
            'marketing' => 'bi-graph-up-arrow text-success',
            'thiet-ke' => 'bi-brush text-danger',
            'kinh-doanh' => 'bi-briefcase text-warning',
            'ngoai-ngu' => 'bi-translate text-info'
        ];
        
        return $icons[$categorySlug] ?? 'bi-book text-secondary';
    }
    
    /**
     * Get subcategory icon class
     * 
     * @param string $categorySlug
     * @param string $subcategorySlug
     * @return string
     */
    public static function getSubcategoryIcon(string $categorySlug, string $subcategorySlug): string
    {
        $icons = [
            'lap-trinh' => [
                'web' => 'bi-globe text-primary',
                'mobile' => 'bi-phone text-primary',
                'ai' => 'bi-robot text-primary',
                'database' => 'bi-database text-primary',
                'security' => 'bi-shield-lock text-primary'
            ],
            'marketing' => [
                'digital' => 'bi-laptop text-success',
                'social-media' => 'bi-share text-success',
                'content' => 'bi-file-earmark-text text-success',
                'seo' => 'bi-search text-success',
                'email' => 'bi-envelope text-success'
            ],
            'thiet-ke' => [
                'ui-ux' => 'bi-palette text-danger',
                'graphic' => 'bi-vector-pen text-danger',
                'web-design' => 'bi-window text-danger',
                '3d' => 'bi-box text-danger',
                'animation' => 'bi-film text-danger'
            ],
            'kinh-doanh' => [
                'startup' => 'bi-rocket-takeoff text-warning',
                'finance' => 'bi-cash-coin text-warning',
                'management' => 'bi-clipboard-data text-warning',
                'sales' => 'bi-cart-check text-warning',
                'ecommerce' => 'bi-shop text-warning'
            ],
            'ngoai-ngu' => [
                'english' => 'bi-chat-quote text-info',
                'japanese' => 'bi-chat-square-text text-info',
                'korean' => 'bi-chat-left-quote text-info',
                'chinese' => 'bi-chat-right-quote text-info',
                'french' => 'bi-chat-square-quote text-info'
            ]
        ];
        
        return $icons[$categorySlug][$subcategorySlug] ?? 'bi-book text-secondary';
    }
} 