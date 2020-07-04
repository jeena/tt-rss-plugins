<?php

class Jp_Existencial extends Plugin {

	function about() {
		return array(1.0,
			"Adds https to existentialcomics.com images",
			"Jeena");
	}

	function init($host) {
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}

	function hook_article_filter($article) {

		if (strpos($article["guid"], "existentialcomics") !== FALSE) {
			if (strpos($article["plugin_data"], "existentialcomics,$owner_uid:") === FALSE) {
				$article["content"] = str_replace('src="//static', 'src="https://static', $article["content"]);
				$article["plugin_data"] = "existentialcomics,$owner_uid:" . $article["plugin_data"];
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
