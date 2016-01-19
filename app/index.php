<?php
session_start(session_name('admin'));
include_once "php/functions.php";
?>
<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="bower/normalize-css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/media.css">
    <!--[if IE 8]>
        <script src="bower/html5shiv/dist/html5shiv.min.js"></script>
        <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <title>Выпускной проект №1. Обо мне.</title>
</head>
<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header__wrapper">
                <a href="/" title="LoftSchool. Корченов Илья" class="logo">
                    <h1 class="logo__title">
                        LoftSchool. Корченов Илья
                    </h1>
                    <img class="logo__img" src="img/logo.png" alt="LoftSchool. Корченов Илья">
                </a>
                <ul class="social-list cf">
                    <li class="social-list__item"><a href="https://www.facebook.com" class="socials socials_facebook" title="Facebook" target="_blank">Facebook</a></li>
                    <li class="social-list__item"><a href="https://vk.com/id44931502" class="socials socials_vk" title="Вконтакте" target="_blank">Вконтакте</a></li>
                    <li class="social-list__item"><a href="https://twitter.com/" class="socials socials_twitter" title="Twitter" target="_blank">Twitter</a></li>
                    <li class="social-list__item"><a href="https://github.com/KorilSalsen" class="socials socials_github" title="GitHub" target="_blank">GitHub</a></li>
                </ul>
                <a href="#" class="open-menu">Меню</a>
            </div>
        </header>
        <div class="page cf">
            <section class="content">
                <!--Основная информация-->
                <article class="content-block">
                    <h3 class="content-block__tittle">Основная информация</h3>
                    <div class="content-block__container content-block__container_info cf">
                        <div class="avatar-wrapper">
                            <div class="avatar">
                                <img src="img/photo.jpg" alt="Это я" class="avatar__photo">
                            </div>
                        </div>
                        <div class="block-info">
                            <ul class="info-list">
                                <li class="info-list__item">
                                    <span class="key">Меня зовут: </span>
                                    <span class="value">Корченов Илья Сергеевич</span>
                                </li>
                                <li class="info-list__item">
                                    <span class="key">Мой возраст: </span>
                                    <span class="value">24 года</span>
                                </li>
                                <li class="info-list__item">
                                    <span class="key">Мой город: </span>
                                    <span class="value">Липецк, Россия</span>
                                </li>
                                <li class="info-list__item">
                                    <span class="key">Моя специализация:  </span>
                                    <span class="value">FRONTEND разработчик</span>
                                </li>
                                <li class="info-list__item info-list__item_skills cf">
                                    <div class="key key_skills">Ключевые навыки: </div>
                                    <ul class="skills-list cf">
                                        <li class="skill">html</li>
                                        <li class="skill">css</li>
                                        <li class="skill">javascript</li>
                                        <li class="skill">git</li>
                                        <li class="skill">gulp</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
                <!-- Опыт работы-->
                <article class="content-block">
                    <h3 class="content-block__tittle">Опыт работы</h3>
                    <div class="content-block__container content-block__container_list">
                        <ul class="content-list">
                            <li class="content-list__item content-list__item_first">
                                <p class="place place_work">ОАО ЮВЭМ-1 - Электромонтажник</p>
                                <p class="date">Август 2011 - Август 2013</p>
                            </li>
                            <li class="content-list__item">
                                <p class="place place_work">ООО "ЛЗИД" - Техник-энергетик</p>
                                <p class="date">Октябрь 2013 - по настоящее время</p>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Образование-->
                <article class="content-block">
                    <h3 class="content-block__tittle">Образование</h3>
                    <div class="content-block__container content-block__container_list">
                        <ul class="content-list">
                            <li class="content-list__item content-list__item_first">
                                <p class="place place_school">Среднее. МОУ СОШ №40</p>
                                <p class="date">1998 - 2007</p>
                            </li>
                            <li class="content-list__item">
                                <p class="place place_graduate">Среднее - специальное. Липецкий машиностроительный колледж</p>
                                <p class="date">2007 - 2011</p>
                            </li>
                            <li class="content-list__item">
                                <p class="place place_graduate">Высшее. Липецкий государственный технический университет</p>
                                <p class="date">2011 - 2015</p>
                            </li>
                            <li class="content-list__item">
                                <p class="place place_file">Курсы Loftshool.ru</p>
                                <p class="date">Ноябрь 2015 - по настоящее время</p>
                            </li>
                        </ul>
                    </div>
                </article>
            </section>
            <aside class="sidebar">
                <!-- Меню-->
                <nav class="menu">
                    <ul class="menu-list menu-list_hide">
                        <li class="menu-list__item"><a class="buttons buttons_active" href="" title="Обо мне">Обо мне</a></li>
                        <li class="menu-list__item"><a class="buttons" href="works.php" title="Мои Работы">Мои Работы</a></li>
                        <li class="menu-list__item"><a class="buttons" href="feedback.php" title="Обратная связь">Обратная связь</a></li>
                    </ul>
                    <!-- Контакты-->
                    <div class="contacts-wrapper">
                        <div class="contacts-list__title">Контакты</div>
                        <ul class="contacts-list cf">
                            <li class="contacts-list__item"><a href="mailto:ikorchenov@bk.ru" class="buttons buttons_contacts buttons_mail" title="Электронная почта">ikorchenov@bk.ru</a></li>
                            <li class="contacts-list__item"><a href="tel:+79205440827" class="buttons buttons_contacts buttons_phone" title="Телефон">+79205440827</a></li>
                            <li class="contacts-list__item"><a href="skype:ilya_korchenov" class="buttons buttons_contacts buttons_skype" title="Skype">ilya_korchenov</a></li>
                        </ul>
                    </div>
                    <!--Дополнительные соц кнопки-->
                    <ul class="social-list social-list_bottom cf">
                        <li class="social-list__item"><a href="https://www.facebook.com" class="socials socials_facebook" title="Facebook" target="_blank">Facebook</a></li>
                        <li class="social-list__item"><a href="https://vk.com/id44931502" class="socials socials_vk" title="Вконтакте" target="_blank">Вконтакте</a></li>
                        <li class="social-list__item"><a href="https://twitter.com/" class="socials socials_twitter" title="Twitter" target="_blank">Twitter</a></li>
                        <li class="social-list__item"><a href="https://github.com/KorilSalsen" class="socials socials_github" title="GitHub" target="_blank">GitHub</a></li>
                    </ul>
                </nav>
            </aside>
        </div>
    </div>
    <footer class="footer">
        <div class="copyright">
            <?php print_login_button() ?>
            <div class="copyright__text">© 2015. Это мой сайт, пожалуйста, не копируйте и не воруйте его!</div>
        </div>
    </footer>
    <script src="bower/jquery/dist/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>