# Тестовое задание на должность web-программист

* Компания: [welbex.ru](https://welbex.ru/)

---

Нужно разработать плагин “Календарь событий” для CMS WordPress

---

### Техническое задание

#### 1. Категория календарей

Должны быть категории событий, которые можно добавлять/удалять/редактировать. Например: забеги, соревнования по бодибилдингу, чемпионат мира по футболу и т.д.

Пример:

<img width="769" alt="Сalendars" src="https://user-images.githubusercontent.com/25084286/61585666-de3d8400-ab69-11e9-9894-864f23f870ae.png">

#### 2. Страны

Страны проведение события, которые можно добавлять/удалять/редактировать.

Пример:

<img width="769" alt="Country" src="https://user-images.githubusercontent.com/25084286/61585667-e3023800-ab69-11e9-8665-4436a1d136c6.png">

#### 3. События

Должны быть сами события, которые можно добавлять/удалять/редактировать. События включают в себя:
1.	Название
2.	Дата проведения
3.	Страна проведения
4.	Город проведения
5.	Категория календаря

`Ничего больше быть не должно.`

Пример:

<img width="769" alt="Event" src="https://user-images.githubusercontent.com/25084286/61585669-e5fd2880-ab69-11e9-8275-f88859520117.png">

#### 4. Клиентская часть

Должна быть возможность вставить данный календарь на любую страницу через шорткод: 
```
[prefix_calendar category='3']

//где category это id категории календаря
```
Вид календаря на frontend должен быть, как jquery календарь, любой. И соответственно на календаре представлены события.

[Пример](https://fullcalendar.io/)

#### 5. Клиентская часть - события за день

Страница с категорией календаря выводит все события в этой категории просто списком.

Пример:

<img width="769" alt="Data" src="https://user-images.githubusercontent.com/25084286/61585670-ea294600-ab69-11e9-8865-faaa93615011.png">
