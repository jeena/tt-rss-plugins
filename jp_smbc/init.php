<?php

class Jp_SMBC extends Plugin {

	function about() {
		return array(1.0,
			"Put image in paragraph in SMBC",
			"Jeena");
	}

	function init($host) {
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}

	function hook_article_filter($article) {

		if (strpos($article["guid"], "www.smbc-comics.com") !== FALSE) {
			if (strpos($article["plugin_data"], "smbc,$owner_uid:") === FALSE) {
				$article["content"] = "<p>" + $article["content"];
				$article["plugin_data"] = "smbc,$owner_uid:" . $article["plugin_data"];
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
