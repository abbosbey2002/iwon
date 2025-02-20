<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $translations = [
            // 1. mobile_app
            [
                'key' => 'mobile_app',
                'language_code' => 'en',
                'text' => 'iWon Mobile App',
            ],
            [
                'key' => 'mobile_app',
                'language_code' => 'ru',
                'text' => 'Мобильное приложение iWon',
            ],
            [
                'key' => 'mobile_app',
                'language_code' => 'uz',
                'text' => 'iWon ilovasini yuklab oling',
            ],
            // 2. download_app
            [
                'key' => 'download_app',
                'language_code' => 'en',
                'text' => 'Download the iWon App and enjoy all its features',
            ],
            [
                'key' => 'download_app',
                'language_code' => 'ru',
                'text' => 'Скачайте приложение iWon и используйте все его возможности',
            ],
            [
                'key' => 'download_app',
                'language_code' => 'uz',
                'text' => 'iWon ilovasini yuklab olib, barcha imkoniyatlardan foydalaning',
            ],
            // 3. next_step
            [
                'key' => 'next_step',
                'language_code' => 'en',
                'text' => 'Proceed to the next step',
            ],
            [
                'key' => 'next_step',
                'language_code' => 'ru',
                'text' => 'Перейти к следующему шагу',
            ],
            [
                'key' => 'next_step',
                'language_code' => 'uz',
                'text' => 'Keyingi bosqichga o‘ting',
            ],
            // 4. already_have
            [
                'key' => 'already_have',
                'language_code' => 'en',
                'text' => 'Is the iWon App already installed?',
            ],
            [
                'key' => 'already_have',
                'language_code' => 'ru',
                'text' => 'Приложение iWon уже установлено?',
            ],
            [
                'key' => 'already_have',
                'language_code' => 'uz',
                'text' => 'iWon ilovasi allaqachon o‘rnatilganmi?',
            ],
            // 5. get_voucher
            [
                'key' => 'get_voucher',
                'language_code' => 'en',
                'text' => 'Get Voucher',
            ],
            [
                'key' => 'get_voucher',
                'language_code' => 'ru',
                'text' => 'Получить ваучер',
            ],
            [
                'key' => 'get_voucher',
                'language_code' => 'uz',
                'text' => 'Voucher olish',
            ],
            // 6. you_have_no_voucher
            [
                'key' => 'you_have_no_voucher',
                'language_code' => 'en',
                'text' => 'Don’t have a voucher?',
            ],
            [
                'key' => 'you_have_no_voucher',
                'language_code' => 'ru',
                'text' => 'У вас нет ваучера?',
            ],
            [
                'key' => 'you_have_no_voucher',
                'language_code' => 'uz',
                'text' => 'Sizda voucher yo‘qmi?',
            ],
            // 7. voucher_confirmation
            [
                'key' => 'voucher_confirmation',
                'language_code' => 'en',
                'text' => 'Voucher Confirmation',
            ],
            [
                'key' => 'voucher_confirmation',
                'language_code' => 'ru',
                'text' => 'Подтверждение ваучера',
            ],
            [
                'key' => 'voucher_confirmation',
                'language_code' => 'uz',
                'text' => 'Voucher Tasdiqlash',
            ],
            // 8. voucher_and_phone_enter
            [
                'key' => 'voucher_and_phone_enter',
                'language_code' => 'en',
                'text' => 'Enter your phone number and voucher code!',
            ],
            [
                'key' => 'voucher_and_phone_enter',
                'language_code' => 'ru',
                'text' => 'Введите ваш номер телефона и код ваучера!',
            ],
            [
                'key' => 'voucher_and_phone_enter',
                'language_code' => 'uz',
                'text' => 'Telefon raqamingiz va voucher kodini kiriting!',
            ],
            // 9. enter_phone
            [
                'key' => 'enter_phone',
                'language_code' => 'en',
                'text' => 'Enter your phone number',
            ],
            [
                'key' => 'enter_phone',
                'language_code' => 'ru',
                'text' => 'Введите ваш номер телефона',
            ],
            [
                'key' => 'enter_phone',
                'language_code' => 'uz',
                'text' => 'Telefon raqamingizni kiriting',
            ],
            // 10. enter_voucher
            [
                'key' => 'enter_voucher',
                'language_code' => 'en',
                'text' => 'Enter the voucher code',
            ],
            [
                'key' => 'enter_voucher',
                'language_code' => 'ru',
                'text' => 'Введите код ваучера',
            ],
            [
                'key' => 'enter_voucher',
                'language_code' => 'uz',
                'text' => 'Voucher kodini kiriting',
            ],
            // 11. confirm
            [
                'key' => 'confirm',
                'language_code' => 'en',
                'text' => 'Confirm',
            ],
            [
                'key' => 'confirm',
                'language_code' => 'ru',
                'text' => 'Подтвердить',
            ],
            [
                'key' => 'confirm',
                'language_code' => 'uz',
                'text' => 'Tasdiqlash',
            ],
            // 12. time
            [
                'key' => 'time',
                'language_code' => 'en',
                'text' => 'Time:',
            ],
            [
                'key' => 'time',
                'language_code' => 'ru',
                'text' => 'Время:',
            ],
            [
                'key' => 'time',
                'language_code' => 'uz',
                'text' => 'Vaqt:',
            ],
            // 13. resent_code
            [
                'key' => 'resent_code',
                'language_code' => 'en',
                'text' => 'Resend Code',
            ],
            [
                'key' => 'resent_code',
                'language_code' => 'ru',
                'text' => 'Отправить заново',
            ],
            [
                'key' => 'resent_code',
                'language_code' => 'uz',
                'text' => 'Qaytadan yuborish',
            ],
        ];

        foreach ($translations as $translation) {
            DB::table('translations')->updateOrInsert(
                [
                    'key' => $translation['key'],
                    'language_code' => $translation['language_code'],
                ],
                [
                    'text' => $translation['text'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
