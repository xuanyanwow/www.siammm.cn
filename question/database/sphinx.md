# Sphinx：轻量全文检索入门

## 什么是 Sphinx

Sphinx 是一个独立的全文检索引擎，可以把它理解为“给业务库外挂一个专门做搜索的组件”。

和直接在 MySQL 里 `like '%xx%'` 相比，Sphinx 的核心优势是：

- 倒排索引，文本检索更快
- 业务库和搜索职责分离，减轻主库压力
- 支持相关性排序、权重、分页等常见搜索能力

它常见的使用模式是：

1. 从 MySQL/PostgreSQL 拉取数据建立索引
2. 应用通过 Sphinx 查询接口做检索
3. 详情页再回源 MySQL（或其他存储）查完整字段

这和 ES 的思路类似：搜索引擎里尽量只放“检索需要的字段”，减少索引体积，提升命中缓存后的查询速度。

## Sphinx 怎么连接

下面用最小链路说明：`MySQL -> Sphinx 建索引 -> 应用查询`。

### 1. 配置数据源和索引

在 `sphinx.conf` 里定义 `source` 和 `index`（示例）：

```conf
source src_article
{
	type            = mysql
	sql_host        = 127.0.0.1
	sql_user        = root
	sql_pass        = 123456
	sql_db          = blog
	sql_port        = 3306

	sql_query       = \
		SELECT id, title, content, UNIX_TIMESTAMP(updated_at) AS updated_at \
		FROM article
}

index article
{
	source          = src_article
	path            = /var/lib/sphinx/article

	charset_type    = utf-8
	min_word_len    = 1
}

searchd
{
	listen          = 9312
	listen          = 9306:mysql41
	log             = /var/log/sphinx/searchd.log
	query_log       = /var/log/sphinx/query.log
	pid_file        = /var/run/sphinx/searchd.pid
}
```

说明：

- `9306:mysql41` 代表可用 MySQL 协议连接（SphinxQL）
- `sql_query` 里的 `id` 必须是唯一主键

### 2. 构建索引并启动服务

```bash
indexer --config /etc/sphinx/sphinx.conf --all
searchd --config /etc/sphinx/sphinx.conf
```

如果是增量重建索引，可用：

```bash
indexer --rotate --all
```

### 3. 用 SphinxQL 连接查询

Sphinx 支持 MySQL 协议，所以可以直接用 MySQL 客户端连：

```bash
mysql -h127.0.0.1 -P9306
```

查询示例：

```sql
SHOW TABLES;
SELECT id, WEIGHT() AS w
FROM article
WHERE MATCH('搜索 架构')
ORDER BY w DESC
LIMIT 20;
```

应用代码里也一样，使用普通 MySQL 驱动，把端口改成 `9306` 即可。

## 实战建议（简洁版）

- 索引只放搜索需要字段，详情字段回源数据库
- 控制深分页，优先“下一页”滚动方式
- 热词/热点数据定时预热，减少冷读
- 定期观察 `query_log`，持续优化分词和权重

## 一句话总结

Sphinx 适合做“高性价比全文检索”：部署轻、接入快、对 MySQL 体系友好。先跑通 `source/index/searchd/SphinxQL` 这条最小链路，再逐步做增量索引和排序优化即可。


## 推荐客户端

GoNavi