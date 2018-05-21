<?php

class Jp_Noisey extends Plugin {

	function about() {
		return array(1.0,
			"Decode html for Noisey blog",
			"Jeena");
	}

	function init($host) {
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}

	function hook_article_filter($article) {

		if (strpos($article["link"], "https://noisey.vice.com/de/article/") !== FALSE) {
			if (strpos($article["plugin_data"], "noisey,$owner_uid:") === FALSE) {
				$article["content"] = html_entity_decode($article["content"]);
				$article["plugin_data"] = "noisey,$owner_uid:" . $article["plugin_data"];
			} else if (isset($article["stored"]["content"])) {
				$article["content"] = $article["stored"]["content"];
			}
		}

		return $article;
	}

	function api_version() {
		return 2;
	}

}

