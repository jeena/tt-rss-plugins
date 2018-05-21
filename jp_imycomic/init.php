<?php

class Jp_Imycomic extends Plugin {

	function about() {
		return array(1.0,
			"Replace to big images in imycomic.com",
			"Jeena");
	}

	function init($host) {
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}

	function hook_article_filter($article) {

		if (strpos($article["guid"], "www.imycomic.com") !== FALSE) {
			if (strpos($article["plugin_data"], "imycomic,$owner_uid:") === FALSE) {
				$article["content"] = str_replace("-150x150.jpg", ".jpg", $article["content"]);
				$article["content"] = str_replace('width="150" height="150"', '', $article["content"]);
				$article["plugin_data"] = "imycomic,$owner_uid:" . $article["plugin_data"];
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

