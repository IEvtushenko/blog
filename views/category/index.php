{% extends "/layouts/main.php" %}

{% block head %}
{{ parent() }}
{% endblock %}

{% block carousel %}
{{ parent() }}
{% endblock %}

{% block main %}
<div class="container zerogrid">

    <!-- Start Posts Container -->
    <div class="col-2-3" id="post-container">
        <div class="wrap-col">

            {% for singleNews in News %}


            <!-- Start Post Item -->
            <div class="post">
                <div class="post-margin">

                    <div class="post-avatar">
                        <div class="avatar-frame"></div>
                        <img alt=''
                             src='http://1.gravatar.com/avatar/16afd22c8bf5c2398b206a76c9316a3c?s=70&d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D70&r=G'
                             class='avatar avatar-70 photo' height='70' width='70'/></div>

                    <h4 class="post-title"><a href="news/article?id={{ singleNews.id }}">{{ singleNews.title }}</a></h4>
                    <ul class="post-status">
                        <li><i class="fa fa-clock-o"></i>{{ singleNews.date|date("d-m-Y")}}</li>
                        <li><i class="fa fa-folder-open-o"></i><a
                                href="/category/{{ singleNews.category_id }}"
                                title="Всё из категории {{ singleNews.category_name }}"
                                rel="category">{{ singleNews.category_name }}</a></li>
                        <li><i class="fa fa-comment-o"></i>Нет комментариев</li>
                    </ul>
                    <div class="clear"></div>
                </div>

                <div class="featured-image">
                    <img src="/templates/img/small/{{ singleNews.id }}.jpg"
                         class="attachment-post-standard "/>
                    <div class="post-icon">
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                    </div>
                </div>

                <div class="post-margin">
                    <p>{{ singleNews.short_content }}</p>
                </div>
                <div class="author-div">
                    <p>{{ singleNews.author_name }}</p>
                    <ul class="post-social">

                        <li><a href="facebook.com" target="_blank">
                                <i class="fa fa-facebook"></i></a>
                        </li>

                        <li>
                            <a href="twitter.com" target="_blank">
                                <i class="fa fa-twitter"></i></a>
                        </li>

                        <li>
                            <a href="google.com" target="_blank">
                                <i class="fa fa-google-plus"></i></a>
                        </li>

                        <li>
                            <!--                            заблокирован в РФ-->
                            <a href="www.linkedin.com" target="_blank">
                                <i class="fa fa-linkedin"></i></a>
                        </li>

                        <li>
                            <a href="news/article?id={{ singleNews.id }}" class="readmore">Читать дальше
                                <i class="fa fa-arrow-circle-o-right"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            {% endfor %}
            <!-- End Post Item -->


            <!-- Start Pagination -->
            <div class="spacing-20"></div>
            {% autoescape false %}
            {{ pagination }}
            {% endautoescape %}
            <!--            <ul class="pagination">-->
            <!--                <li class='current'><a href=''>1</a></li>-->
            <!--                <li><a href=''>2</a></li>-->
            <!--                <li><a href=''>3</a></li>-->
            <!--                <li><a href=''>4</a></li>-->
            <!--            </ul>-->
            <!-- End Pagination -->

            <div class="clear"></div>
        </div>

    </div>
    <!-- End Posts Container -->
    {% block sidebar %}
    {% include '/layouts/sidebar.php' %}
    {% endblock %}

    <div class="clear"></div>
</div>
<!-- End Main Container -->
{% endblock %}

{% block footer %}
{{ parent() }}
{% endblock %}