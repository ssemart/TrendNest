<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How can I track my order?',
                'answer' => 'You can track your order by logging into your account and visiting the "Order History" section. There you\'ll find the tracking number and current status of your order.',
                'is_active' => true,
                'priority' => 1
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept various payment methods including credit/debit cards (Visa, MasterCard, American Express), PayPal, and bank transfers.',
                'is_active' => true,
                'priority' => 2
            ],
            [
                'question' => 'What is your return policy?',
                'answer' => 'We offer a 30-day return policy for most items. Products must be unused and in their original packaging. Please visit our Returns page for detailed information.',
                'is_active' => true,
                'priority' => 3
            ],
            [
                'question' => 'How long does shipping take?',
                'answer' => 'Standard shipping typically takes 3-5 business days within the country. International shipping can take 7-14 business days depending on the destination.',
                'is_active' => true,
                'priority' => 4
            ],
            [
                'question' => 'Do you ship internationally?',
                'answer' => 'Yes, we ship to most countries worldwide. Shipping costs and delivery times vary by location. You can check shipping rates at checkout.',
                'is_active' => true,
                'priority' => 5
            ],
            [
                'question' => 'How can I contact customer support?',
                'answer' => 'You can reach our customer support team through email at support@trendnest.com, by phone at 1-800-TREND, or through this chat feature. Our support hours are Monday-Friday, 9AM-6PM EST.',
                'is_active' => true,
                'priority' => 6
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
