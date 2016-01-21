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
    <link rel="stylesheet" href="css/works.css">
    <link rel="stylesheet" href="css/media.css">
    <!--[if IE 8]>
        <script src="bower/html5shiv/dist/html5shiv.min.js"></script>
        <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <title>Корченов.ру. Мои работы.</title>
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
                <!--Работы-->
                <article class="content-block">
                    <h3 class="content-block__tittle">Мои работы</h3>
                    <div class="content-block__container content-block__container_works cf">
                        <ul class="works-list">
                            <?php print_projects() ?>
                        </ul>
                    </div>
                </article>
            </section>
            <aside class="sidebar">
                <!-- Меню-->
                <nav class="menu ">
                    <ul class="menu-list menu-list_hide">
                        <li class="menu-list__item"><a class="buttons" href="index.php" title="Обо мне">Обо мне</a></li>
                        <li class="menu-list__item"><a class="buttons buttons_active" href="" title="Мои Работы">Мои Работы</a></li>
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
        <!--Попап-->
        <div class="popup" data-popup-name="new-project">
            <div class="content-block__container content-block__container_popup">
                <p class="form-title form-title_popup">Добавление проекта</p>
                <a href="" class="popup__close" title="Close">Close</a>
                <div class="server-message">
                    <a href="" class="server-message__close" title="Close">Close</a>
                    <p class="server-message__title"></p>
                    <p class="server-message__text"></p>
                </div>
                <!--Форма-->
                <form action="/" class="popup-form">
                    <!--Название-->
                    <div class="input input_popup">
                        <label class="input__label input__label_popup" for="name-of-work">Название проекта</label>
                        <input id="name-of-work" class="input__text input__text_popup" type="text" name="work-title" placeholder="Введите название" data-tooltip="введите название">
                    </div>
                    <!--Картинка-->
                    <div class="input input_popup">
                        <label class="input__label input__label_popup" for="pic-of-work">Картинка проекта</label>
                        <label for="pic-of-work" class="upload-label-wrapper">
                            <span class="fake-input-wrapper ">
                                <input class="input__text input__fake-upload input__text_popup" type="text" placeholder="Загрузите изображение" readonly data-tooltip="картинка">
                            </span>
                            <span class="fake-upload-button">Обзор</span>
                            <input id="pic-of-work" class="input__upload" type="file" name="work-pic">
                        </label>
                    </div>
                    <!--Ссылка-->
                    <div class="input input_popup">
                        <label class="input__label input__label_popup" for="link-of-work">URL проекта</label>
                        <input id="link-of-work" class="input__text input__text_popup" type="text" name="work-url" placeholder="Добавте ссылку" data-tooltip="ссылка на проект">
                    </div>
                    <!--Описание-->
                    <div class="input input_popup">
                        <label class="input__label input__label_popup" for="description-of-work">Описание</label>
                        <textarea id="description-of-work" class="input__text input__text_textarea input__text_textarea-popup input__text_popup"  name="work-description" placeholder="Пара слов о Вашем проекте" data-tooltip="описание проекта"></textarea>
                    </div>
                    <!--Кнопка-->
                    <input type="submit" class="input__button input__button_submit input__button_submit-popup" value="Добавить">
                </form>
            </div>
        </div>
    </div>
    <!--Футер-->
    <footer class="footer">
        <div class="copyright">
            <?php print_login_button() ?>
            <div class="copyright__text">© 2015. Это мой сайт, пожалуйста, не копируйте и не воруйте его!</div>
        </div>
    </footer>
    <script src="bower/jquery/dist/jquery.min.js"></script>
    <!--[if IE 8]>
    <script src="bower/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->
    <script src="js/main.js"></script>
</body>
</html>