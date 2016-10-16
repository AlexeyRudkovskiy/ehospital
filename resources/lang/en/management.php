<?php

return [

    'global' => [
        'yes' => 'Да',
        'create' => 'Создать',
        'delete' => 'Удалить',
        'edit' => 'Редактировать'
    ],

    'property' => [
        'empty' => 'свойство не установлено'
    ],

    'organization' => [
        'type' => [
            'legal' => 'юридическая',
            'private' => 'частное'
        ],
        'saved' => 'Организация успешно сохранена',
        'create' => 'Организация успешно создана'
    ],
    'atcClassification' => [
        'created' => 'АТС классификация создана',
        'saved' => 'АТС классификация сохранена'
    ],

    'breadcrumbs' => [
        'index' => 'EHospital',
        'organization' => [
            'title' => "Организации",
            'index' => 'Список организаций'
        ],
        'user' => [
            'title' => 'Пользователи'
        ],
        'contractor' => [
            'title' => 'Контрагенты'
        ],
        'department' => [
            'title' => 'Отделения'
        ],
        'manufacturer' => [
            'title' => 'Производители'
        ],
        'medicament' => [
            'title' => 'Медикаменты',
            'show' => 'Просмотр медикамента'
        ],
        'atcClassification' => [
            'title' => 'АТС классификации'
        ],
        'patient' => [
            'title' => 'Пациенты'
        ]
    ],

    'label' => [
        'save' => 'Сохранить',
        'pagination' => [
            'next' => 'следующая страница',
            'previous' => 'предыдущая страница'
        ],

        'organization' => [
            'type' => 'Тип организации',
            'name' => 'Название организации',
            'legal' => 'Юр. лицо',
            'private' => 'Физ. лицо'
        ],

        'medicament' => [
            'info' => 'Общая информация',
            'revisions' => 'Изменения',
            'series' => 'Серии',
            'statistic' => 'Статистика',
            'income' => 'Поступление',
            'outgoing' => 'Отпуск в отделение'
        ],

        'user' => [
            'info' => 'О пользователе',
            'schedule' => 'График работы',
            'timeDelta' => 'На пациента отведено <b>:delta</b> часов'
        ],

        'patient' => [
            'cures' => 'Курсы лечения',
            'card' => 'Информация о пациенте',
            'phone' => 'Телефон',
            'birthday' => 'День рождения',
            'homeless' => 'Бездомный',
            'ukrainian' => 'Украинец',
            'hospital_employee' => 'Работник больницы',
            'doctors' => 'Доктора',
            'noCures' => 'нет курсов лечения',

            'inspection' => [
                'edit' => 'Редактировать первичный осмотр',

                'bloodGroup' => 'Группа крови',
                'rhFactor' => 'Резус фактор',
                'bloodTransfusions' => 'Переливания крови',

                'rhFactorPositive' => 'Позитивный',
                'rhFactorNegative' => 'Негативный'
            ]
        ],

        'atcClassification' => [
            'noParentCategory' => 'Подкатегория'
        ]

    ],

    // Тексты уведомлений
    'notification' => [
        'medicament' => [
            'modified' => 'Медикамент успешно сохранён'
        ],

        'patient' => [
            'modified' => 'Данные пациента успешно сохранены'
        ]
    ]
];