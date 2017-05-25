{% block head %}
{% include '/layouts/header.php' %}
{% endblock %}
<!---->
<!-- Start Featured Carousel -->
{% block carousel %}
<div class="container zerogrid">
    <div class="list_carousel">

        <ul id="featured-posts">
            {% set number = 'last' %}

            {% for single in recommended %}

            <li class="{{ number }} carousel-item">

                <div class="post-margin">

                    <h6><a href="news/article?id={{ single.id }}">{{ single.short_title }}</a></h6>
                    <span><i class="fa fa-clock-o"></i> {{ single.date|date("d-m-Y")}} </span>
                </div>

                <div class="featured-image">
                    <img width="290" height="130" src="/templates/img/recommended/{{ single.id }}.jpg"/>
                    <div class="post-icon">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-picture-o fa-stack-1x fa-inverse"></i>                    </span>
                    </div>
                </div>


                <div class="post-margin">
                    <p>{{ single.title }}</p>
                </div>
            </li>

            {% endfor %}

        </ul>

        <div class="clear"></div>

        <div class="carousel-controls">
            <a id="prev2" class="prev" href="#"><i class="fa fa-angle-left"></i></a>
            <a id="next2" class="next" href="#"><i class="fa fa-angle-right"></i></a>
            <div class="clear"></div>
        </div>
    </div>
</div>
{% endblock %}

<!-- Start Main Container -->
{% block main %}

{% endblock %}

{% block footer %}
{% include '/layouts/footer.php' %}
{% endblock %}