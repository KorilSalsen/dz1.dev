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
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="css/media.css">
    <!--[if IE 8]>
        <script src="bower/html5shiv/dist/html5shiv.min.js"></script>
        <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <title>Выпускной проект №1. Обратная связь.</title>
</head>
<body>
    <div class="page-wrapper">
        <!--Хедер-->
        <header class="header">
            <div class="header__wrapper">
                <a href="/" title="LoftSchool. Корченов Илья" class="logo">
                    <h1 class="logo__title">LoftSchool. Корченов Илья</h1>
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
        <!--Страница-->
        <div class="page cf">
            <section class="content">
                <!--Форма обратной связиы-->
                <article class="content-block">
                    <h3 class="content-block__tittle">У вас интересный проект? Напишите мне</h3>
                    <div class="content-block__container content-block__container_feedback cf">
                        <!--Форма-->
                        <form action="/" class="feedback-form">
                            <!--Имя и email-->
                            <div class="input-wrapper cf">
                                <!--Имя-->
                                <div class="input input_name">
                                    <label for="name" class="input__label input__label_feedback">Имя</label>
                                    <input id="name" class="input__text input__text_name" type="text" name="feedback-name" placeholder="Как к вам обращаться?" data-tooltip="введите имя">
                                </div>
                                <!--Email-->
                                <div class="input input_email">
                                    <label for="email" class="input__label input__label_feedback">Email</label>
                                    <input id="email" class="input__text input__text_email" type="email" name="feedback-email" placeholder="Куда мне писать?" data-tooltip="введите email" data-tooltip-position="right">
                                </div>
                            </div>
                            <!--Сообщение-->
                            <div class="input input_message">
                                <label for="message" class="input__label">Сообщение</label>
                                <textarea id="message" class="input__text input__text_textarea" name="feedback-message" placeholder="Кратко в чем суть" data-tooltip="ваш вопрос"></textarea>
                            </div>
                            <!--Капча-->
                            <div class="input input_captcha">
                                <div class="input__label input__label_captcha">Подтвердите, что вы не робот</div>
                                <div class="g-recaptcha input__text" data-sitekey="6LcOphMTAAAAAI9S0CCJVJPlNYKWm8t9LQ6ySJ9H" data-tooltip="пройдите проверку" data-callback="recaptchaCallback"></div>
                            </div>
                            <!--Кнопки-->
                            <div class="input input_buttons cf">
                                <input type="submit" class="input__button input__button_submit" value="Отправить">
                                <input type="reset" class="input__button input__button_reset" value="Сбросить">
                            </div>
                        </form>
                        <div class="server-message">
                            <a href="" class="server-message__close" title="Close">Close</a>
                            <p class="server-message__title"></p>
                            <p class="server-message__text"></p>
                        </div>
                    </div>
                </article>
            </section>
            <aside class="sidebar">
                <!-- Меню-->
                <nav class="menu ">
                    <ul class="menu-list menu-list_hide">
                        <li class="menu-list__item"><a class="buttons" href="index.php" title="Обо мне">Обо мне</a></li>
                        <li class="menu-list__item"><a class="buttons" href="works.php" title="Мои Работы">Мои Работы</a></li>
                        <li class="menu-list__item"><a class="buttons buttons_active" href="" title="Обратная связь">Обратная связь</a></li>
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!--[if IE 8]>
    <script src="bower/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->
    <script src="js/main.js"></script>
</body>
</html>