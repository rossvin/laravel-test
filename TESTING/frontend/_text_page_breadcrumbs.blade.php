<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="/" itemprop="item">
            <span itemprop="name">Главная</span>
        </a>
        <meta itemprop="position" content="1" />
    </li>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a href="{{Request::url()}}" itemprop="item">
            <span itemprop="name">{{ $page->name }}</span>
        </a>
        <meta itemprop="position" content="2" />
    </li>
</ul>