<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Post;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::updateOrCreate([
            'slug' => 'من-نحن',
        ], [
            'title' => 'من نحن',
            'description' => 'وصف',
            'content' => '<p>تُعتبر التجارة الإلكترونية (eCommerce) واحدة من أهم التطورات في عالم التجارة والأعمال خلال العقدين الماضيين. ومع ازدياد الاعتماد على التكنولوجيا والإنترنت، أصبحت التجارة الإلكترونية تتيح للأفراد والشركات فرصة الوصول إلى أسواق جديدة وزيادة قاعدة العملاء بطرق لم تكن متاحة من قبل.</p>',
            'featured_image' => null,
            'post_type' => 'page',
            'ordering' => '1',
            'user_id' => '1',
            'status' => 'publish',
            'published_at' => now(),
            'created_at' => now(),
        ]);

        Post::updateOrCreate([
            'slug' => 'الشروط-والاحكام',
        ], [
            'title' => 'الشروط والاحكام',
            'description' => 'وصف',
            'content' => '<p>محتوى شروط الخدمة.</p>',
            'featured_image' => null,
            'post_type' => 'page',
            'ordering' => '2',
            'user_id' => '1',
            'status' => 'publish',
            'published_at' => now(),
            'created_at' => now(),
        ]);

        Post::updateOrCreate([
            'slug' => 'سياسة-الخصوصية',
        ], [
            'title' => ' سياسة الخصوصية',
            'description' => 'وصف',
            'content' => '<p>محتوى سياسة الخصوصية.</p>',
            'featured_image' => null,
            'post_type' => 'page',
            'ordering' => '3',
            'user_id' => '1',
            'status' => 'publish',
            'published_at' => now(),
            'created_at' => now(),
        ]);
      
        // Create a blog post
        Post::updateOrCreate([
            'slug' => 'أول-مدونة',
        ], [
            'title' => 'أول مدونة',
            'description' => 'وصف المدونة',
            'content' => '<p>هذا هو محتوى أول مدونة لدينا. هنا نتحدث عن مواضيع مثيرة للاهتمام في التجارة الإلكترونية.</p>',
            'featured_image' => null,
            'post_type' => 'post',   
            'ordering' => '1',
            'user_id' => '1',
            'status' => 'publish',
            'published_at' => now(),
            'created_at' => now(),
        ]);
    }
}
