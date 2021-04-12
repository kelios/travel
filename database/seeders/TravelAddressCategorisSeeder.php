<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelAddressCategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $data = [
            [
                'name' => 'Акведук',
                'status' => true
            ],
            [
                'name' => 'Амфитеатр',
                'status' => true

            ],
            [
                'name' => 'Аптека',
                'status' => true

            ],
            [
                'name' => 'Арка',
                'status' => true

            ],
            [
                'name' => 'Арочный мост',
                'status' => true

            ],
            [
                'name' => 'Археологическая достопримечательность',
                'status' => true

            ],
            [
                'name' => 'Архипелаг',
                'status' => true

            ],
            [
                'name' => 'Аэропорт',
                'status' => true

            ],
            [
                'name' => 'Банк',
                'status' => true

            ],
            [
                'name' => 'Бар',
                'status' => true

            ],
            [
                'name' => 'Башня',
                'status' => true

            ],
            [
                'name' => 'Библиотека',
                'status' => true

            ],
            [
                'name' => 'Беседка',
                'status' => true

            ],
            [
                'name' => 'Брама',
                'status' => true

            ],
            [
                'name' => 'Болото',
                'status' => true

            ],
            [
                'name' => 'Больница',
                'status' => true

            ],
            [
                'name' => 'Бункер',
                'status' => true

            ],
            [
                'name' => 'Бухта',
                'status' => true

            ],
            [
                'name' => 'Ветряная мельница',
                'status' => true

            ],
            [
                'name' => 'Водопад',
                'status' => true

            ],
            [
                'name' => 'Водохранилище',
                'status' => true

            ],
            [
                'name' => 'Водяная мельница',
                'status' => true

            ],
            [
                'name' => 'Вокзал',
                'status' => true

            ],
            [
                'name' => 'Вулкан',
                'status' => true

            ],
            [
                'name' => 'Гейзер',
                'status' => true

            ],
            [
                'name' => 'Гора',
                'status' => true

            ],
            [
                'name' => 'Горный хребет',
                'status' => true

            ],
            [
                'name' => 'Горячий источник',
                'status' => true

            ],
            [
                'name' => 'Гостиница',
                'status' => true

            ],
            [
                'name' => 'Гробница',
                'status' => true

            ],
            [
                'name' => 'ГЭС',
                'status' => true

            ],
            [
                'name' => 'Дамба',
                'status' => true

            ],
            [
                'name' => 'Дворец',
                'status' => true

            ],
            [
                'name' => 'Дерево',
                'status' => true

            ],
            [
                'name' => 'Детский парк',
                'status' => true

            ],
            [
                'name' => 'Дом',
                'status' => true

            ],
            [
                'name' => 'Долина',
                'status' => true

            ],
            [
                'name' => 'Дот',
                'status' => true

            ],
            [
                'name' => 'Достопримечательность',
                'status' => true

            ],
            [
                'name' => 'Дюна',
                'status' => true

            ],
            [
                'name' => 'Завод',
                'status' => true

            ],
            [
                'name' => 'Заповедник',
                'status' => true

            ],
            [
                'name' => 'Замок',
                'status' => true

            ],
            [
                'name' => 'Заброшенная деревня',
                'status' => true

            ],
            [
                'name' => 'Заброшенное место',
                'status' => true

            ],
            [
                'name' => 'Зоопарк',
                'status' => true

            ],
            [
                'name' => 'Землянка',
                'status' => true

            ],
            [
                'name' => 'Ипподром',
                'status' => true

            ],
            [
                'name' => 'Казино',
                'status' => true

            ],
            [
                'name' => 'Кафе',
                'status' => true

            ],
            [
                'name' => 'Канал',
                'status' => true

            ],
            [
                'name' => 'Камни и валуны',
                'status' => true

            ],
            [
                'name' => 'Каньон',
                'status' => true

            ],
            [
                'name' => 'Киноплощадка',
                'status' => true

            ],
            [
                'name' => 'Кемпинг',
                'status' => true

            ],
            [
                'name' => 'Кладбище',
                'status' => true

            ],
            [
                'name' => 'Колодец',
                'status' => true

            ],
            [
                'name' => 'Колокольня',
                'status' => true

            ],
            [
                'name' => 'Коралловый риф',
                'status' => true

            ],
            [
                'name' => 'Кратер',
                'status' => true

            ],
            [
                'name' => 'Крепость',
                'status' => true

            ],
            [
                'name' => 'Кресты',
                'status' => true

            ],
            [
                'name' => 'Курган',
                'status' => true

            ],
            [
                'name' => 'Лагуна',
                'status' => true

            ],
            [
                'name' => 'Лагерь',
                'status' => true

            ],
            [
                'name' => 'Ледник',
                'status' => true

            ],
            [
                'name' => 'Лес',
                'status' => true

            ],
            [
                'name' => 'Маяк',
                'status' => true

            ],
            [
                'name' => 'Магазин',
                'status' => true

            ],
            [
                'name' => 'Мавзолей',
                'status' => true

            ],
            [
                'name' => 'Место крушения',
                'status' => true

            ],
            [
                'name' => 'Мечеть',
                'status' => true

            ],
            [
                'name' => 'Могила',
                'status' => true

            ],
            [
                'name' => 'Монастырь',
                'status' => true

            ],
            [
                'name' => 'Мост',
                'status' => true

            ],
            [
                'name' => 'Музей',
                'status' => true

            ],
            [
                'name' => 'Музей под открытым небом',
                'status' => true

            ],
            [
                'name' => 'Мыс',
                'status' => true

            ],
            [
                'name' => 'Национальный парк',
                'status' => true

            ],
            [
                'name' => 'Оазис',
                'status' => true

            ],
            [
                'name' => 'Обсерватория',
                'status' => true

            ],
            [
                'name' => 'Обзорная точка',
                'status' => true

            ],
            [
                'name' => 'Овраг',
                'status' => true

            ],
            [
                'name' => 'Озеро',
                'status' => true

            ],
            [
                'name' => 'Оперный театр',
                'status' => true

            ],
            [
                'name' => 'Остров',
                'status' => true

            ],
            [
                'name' => 'Отель',
                'status' => true

            ],
            [
                'name' => 'Пагода',
                'status' => true

            ],
            [
                'name' => 'Памятник',
                'status' => true

            ],
            [
                'name' => 'Парк',
                'status' => true

            ],
            [
                'name' => 'Парковка',
                'status' => true

            ],
            [
                'name' => 'Парк развлечений',
                'status' => true

            ],
            [
                'name' => 'Паром',
                'status' => true

            ],
            [
                'name' => 'Перевал',
                'status' => true

            ],
            [
                'name' => 'Пустыня',
                'status' => true

            ],
            [
                'name' => 'Природный памятник',
                'status' => true

            ],
            [
                'name' => 'Пещера',
                'status' => true

            ],
            [
                'name' => 'Пивоварня',
                'status' => true

            ],
            [
                'name' => 'Пирамида',
                'status' => true

            ],
            [
                'name' => 'Плато',
                'status' => true

            ],
            [
                'name' => 'Пляж',
                'status' => true

            ],
            [
                'name' => 'Подвесной мост',
                'status' => true

            ],
            [
                'name' => 'Поле боя',
                'status' => true

            ],
            [
                'name' => 'Порт',
                'status' => true

            ],
            [
                'name' => 'Почта',
                'status' => true

            ],
            [
                'name' => 'Пролив',
                'status' => true

            ],
            [
                'name' => 'Ратуша',
                'status' => true

            ],
            [
                'name' => 'Резервация',
                'status' => true

            ],
            [
                'name' => 'Ресторан',
                'status' => true

            ],
            [
                'name' => 'Река',
                'status' => true

            ],
            [
                'name' => 'Религиозная достопримечательность',
                'status' => true

            ],
            [
                'name' => 'Риф',
                'status' => true

            ],
            [
                'name' => 'Родник',
                'status' => true

            ],
            [
                'name' => 'Руины',
                'status' => true

            ],
            [
                'name' => 'Руины замка',
                'status' => true

            ],
            [
                'name' => 'Руины усадьбы',
                'status' => true

            ],
            [
                'name' => 'Руины мельницы',
                'status' => true

            ],
            [
                'name' => 'Руины дворца',
                'status' => true

            ],
            [
                'name' => 'Руины моста',
                'status' => true

            ],
            [
                'name' => 'Руины церкви',
                'status' => true

            ],
            [
                'name' => 'Ручей',
                'status' => true

            ],
            [
                'name' => 'Рынок',
                'status' => true

            ],
            [
                'name' => 'Сад',
                'status' => true

            ],
            [
                'name' => 'Святыня',
                'status' => true

            ],
            [
                'name' => 'Синагога',
                'status' => true

            ],
            [
                'name' => 'Скала',
                'status' => true

            ],
            [
                'name' => 'Собор',
                'status' => true

            ],
            [
                'name' => 'Стадион',
                'status' => true

            ],
            [
                'name' => 'Статуя',
                'status' => true

            ],
            [
                'name' => 'Театр',
                'status' => true

            ],
            [
                'name' => 'Треккинговый маршрут',
                'status' => true

            ],
            [
                'name' => 'Туалет',
                'status' => true

            ],
            [
                'name' => 'Тюрьма',
                'status' => true

            ],
            [
                'name' => 'Университет',
                'status' => true

            ],
            [
                'name' => 'Утес',
                'status' => true

            ],
            [
                'name' => 'Усадьба',
                'status' => true

            ],
            [
                'name' => 'Ущелье',
                'status' => true

            ],
            [
                'name' => 'Форт',
                'status' => true

            ],
            [
                'name' => 'Фьорд',
                'status' => true

            ],
            [
                'name' => 'Холм',
                'status' => true

            ],
            [
                'name' => 'Храм',
                'status' => true

            ],
            [
                'name' => 'Церковь',
                'status' => true

            ],
            [
                'name' => 'Часовня',
                'status' => true

            ],
            [
                'name' => 'Часы',
                'status' => true

            ],
            [
                'name' => 'Чайная плантация',
                'status' => true

            ],
            [
                'name' => 'Шахта',
                'status' => true

            ],

            [
                'name' => 'Экологическая тропа',
                'status' => true

            ],

            ];
        DB::table('category_travel_address')->insert(
            $data
        );
    }
}
