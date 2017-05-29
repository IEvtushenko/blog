{% extends "/layouts/main.php" %}

{% block head %}
{{ parent() }}
{% endblock %}

{% block carousel %}

{% endblock %}

{% block main %}
<!-- Start Main Container -->
<div class="container zerogrid">

    <div class="col-full page-conainer">
        <div class="wrap-col">
            <div class="post-margin">
                <h5 class="page-title">О нас</h5>

                <!-- Start Entry -->
                <p>Меня зовут Иван, я начинающий WEB разработчик.</p>
                <p>Проект ведется в учебных целях, на данный момент реализованна главная страница, страницы категорий, частично админинка.</p>
                <p>В целях тренировки, были использованны, генераторы, исключения, AJAX для записи комментариев, различные библиотеки, pagination, TWIG, monolog, unit:timer.</p>
                <p>В планах, дальнейшая доработка проекта, а именно:</p>
                <ul>
                    <li>Довести до ума панель администратора, CRUD категорий, авторов.</li>
                    <li>Добавить скрипт для автоматического сохранения базы</li>
                    <li>Проверка аутентификации администратора, в админке.</li>
                    <li>Рассылка на почту при добавлении новой статьи.</li>
                    <li>Поиск по сайту.</li>
                    <li>Доделать комментари, а имено отображение к-ва комментариев</li>
                    <li>Исключения доработать и кэширование</li>
                    <li>Добавить js скрипт выбора области для вырезания картинки под новость</li>
                </ul>


                <div class="symple-clear-floats"></div>
                <!-- End Entry -->

            </div>
        </div>
    </div>

    <div class="clear"></div>
</div>
<!-- End Main Container -->
{% endblock %}

{% block footer %}
{{ parent() }}
{% endblock %}