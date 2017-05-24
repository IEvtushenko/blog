{% block head %}
{% include '/layouts/header.php' %}
{% endblock %}
<!---->

{% block main %}
<!-- Start Main Container -->
<div class="container zerogrid">

    <!-- Start Posts Container -->
    <div class="col-8-10" id="post-container">
        <div class="wrap-col">


            <!-- Start Post Item -->
            <div class="post">
                <div class="post">
                    <h1 class="admin-h1">Панель администратора</h1>
                    <a class="admin-h1" href="/admin/save">Добавить новую запись</a>
                    <div class="admin-table-div">
                        <table class="admin-table">
                            <thead class="admin-thead">
                            <th class="admin-td">Номер</th>
                            <th class="admin-td">Изображение</th>
                            <th class="admin-td">Заголовок</th>
                            <th class="admin-td">Категория</th>
                            <th class="admin-td">Рекомендуемое</th>
                            <th class="admin-td">Статус</th>
                            <th class="admin-td">Действие</th>
                            </thead>
                            <tbody>
                            {% for new in allNews %}

                                <tr class="admin-tr">
                                    <td class="admin-td">{{ new.id }}</td>
                                    <td class="admin-td"><img style="border-radius: 3px; height: 75px"
                                                              src="/templates/img/small/{{ new.id }}.jpg"" alt="">
                                    </td>
                                    <td class="admin-td">{{ new.title }}</td>
                                    <td class="admin-td">{{ new.category_name }}</td>
                                    <td class="admin-td">{{ new.is_recommended }}</td>
                                    <td class="admin-td">{{ new.status }}</td>
                                    <td class="admin-td">
                                        <!--                                                <li class="menu-item"><a href="/">Категории</a>-->
                                        <p class="menu-item">
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a
                                                    href="/admin/save?id={{ new.id }}">Редактировать</a></li>
                                            <li class="menu-item"><a href="/admin/delete?id={{ new.id }}">Удалить</a>
                                            </li>
                                        </ul>
                                        </p>

                                        <!--                                                </li>-->
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
                        </table>
                    </div>

                    <div class="clear"></div>
                </div>
                <!-- End Post Item -->
{% endblock %}

{% block footer %}
{% include '/layouts/footer.php' %}
{% endblock %}
