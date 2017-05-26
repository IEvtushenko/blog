<!-- Start Sidebar -->
<div class="col-1-3">
    <div class="wrap-col">
        <div class="widget-container">
            <form role="search" method="get" id="searchform" class="searchform" action="search">
                <div>
                    <label class="screen-reader-text" for="s">Search for:</label>
                    <input type="text" value="" name="s" id="s"/>
                    <input type="submit" id="searchsubmit" value="Поиск"/>
                </div>
            </form>
            {% if message is not empty %}
            <span><i class="fa-stack fa-lg"></i> Ничего не найдено </span>
            {% endif %}
            <div class="clear"></div>
        </div>
        <div class="widget-container"><h6 class="widget-title">Категории</h6>
            <ul>
                {% for category in categories %}
                    <li class="cat-item cat-item-5"><a href="/category?id={{ category.id }}" title="View all posts filed under Apps">{{ category.name }}</a>
                    </li>
                {% endfor %}
            </ul>
            <div class="clear"></div>
        </div>
        <div class="widget-container"><h6 class="widget-title">Последние записи</h6>    <!-- Start Widget -->
            <ul class="widget-recent-posts">
            {% for singleLastNews in lastNews %}
                <li>
                    <div class="post-image">
                        <div class="post-mask"></div>
                        <img width="70" height="70" src="/templates/img/small/{{ singleLastNews.id }}.jpg"
                             class="attachment-post-widget sidebar-img"/>
                    </div>
                    <div>
                        <h6><a href="news/article?id={{ singleLastNews.id }}">{{ singleLastNews.short_title }}</a></h6>
                        <span>{{ singleLastNews.date|date("d-m-Y") }}</span>
                    </div>

                    <div class="clear"></div>
                </li>
            {% endfor %}

            </ul>
            <!-- End Widget -->
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>        <!-- End Sidebar -->