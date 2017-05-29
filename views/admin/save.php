{% block head %}
{% include '/layouts/header.php' %}
{% endblock %}
<!---->
<!-- Start Featured Carousel -->
{% block carousel %}

{% endblock %}

<!-- Start Main Container -->
<div class="container zerogrid">

    <!-- Start Posts Container -->
    <div class="col-8-10" id="post-container">
        <div class="wrap-col">


            <!-- Start Post Item -->
            <div class="post">
                <div>
                    <h1 class="admin-h1">Редактировать запись</h1>
                    <p class="commen-form"><a href="/admin/">Список статей</a></p>
                </div>
                <br>
                {% if errors %}
                {% for error in errors %}

                <p class="commen-form">{{ error.getMessage() }}</p>

                {% endfor %}
                {% endif %}

                <!-- Comment Form -->

                <div class="commen-form">
                    <div id="respond" class="comment-respond">
                        <h3 id="reply-title" class="comment-reply-title">
                            <small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel
                                    Reply</a></small>
                        </h3>
                        <form action="" method="post" id="comment-form-container" class="comment-form"
                              ENCTYPE="multipart/form-data">
                            <p class="comment-notes"></p>
                            <input type="text" name="title" placeholder="Введите заголовок" class="comment-name"
                                   value=""/>
                            <input type="text" name="short_title" maxlength="25" placeholder="Введите краткий заголовок"
                                   class="comment-name"
                                   value="" title="Не более 25 символов"/>
                            <input type="text" name="short_content" placeholder="Введите краткое описание"
                                   class="comment-email" value=""/>

                            <textarea name="content" placeholder="Введите текст статьи "
                                      class="comment-text-area" value=""></textarea>
                            <p class="comment-notes">Категория</p>
                            <select class="comment-email" name="category_id" id="">
                                <option class="admin-save-option" value="1">Спорт</option>
                                <option class="admin-save-option" value="2">Музыка</option>
                                <option class="admin-save-option" value="3">События</option>
                            </select>
                            <p class="comment-notes">Статус</p>
                            <select class="comment-email" name="status" id="">
                                <option class="admin-save-option" value="1" selected>Опубликовать</option>
                                <option class="admin-save-option" value="0">Не опубликовывать</option>
                            </select>
                            <p class="comment-notes">Рекомендуемое</p>
                            <select class="comment-email" name="is_recommended" id="">
                                <option class="admin-save-option" value="1" selected>Рекомендовать</option>
                                <option class="admin-save-option" value="0">Не рекомендовать</option>
                            </select>

                            <p>Загрузите изображение: </p>
                            <input type="file" name="userfile">
                            <p class="form-allowed-tags"></p>
                            <p class="form-submit">
                                <input name="submit" type="submit" id="comment-submit" value="Сохранить"/>
                            </p>
                        </form>
                    </div><!-- #respond -->
                    <div class="clear"></div>
                    </form>
                </div>

                <!-- End Comment Form -->
                <div class="clear"></div>
            </div>
            <!-- End Post Item -->

            {% block main %}

            {% endblock %}

            {% block footer %}
            {% include '/layouts/footer.php' %}
            {% endblock %}
