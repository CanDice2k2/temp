<?php

namespace Database\Seeders;

use App\Models\ScoreCategory;
use Illuminate\Database\Seeder;

class ScoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scoreCategories = ["Kỷ luật", "Chăm chỉ", "Sáng tạo", "Hợp tác", "Thái độ làm việc", "Chuyên môn"];

        foreach($scoreCategories as $category)
        {
            ScoreCategory::create(['name' => $category]);
        }
    }
}
