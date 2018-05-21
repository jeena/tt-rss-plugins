<?php

class Jp_Stuttmann extends Plugin {

	function about() {
		return array(1.0,
			"Replace to big images in stuttmann-karikaturen.de",
			"Jeena");
	}

	function init($host) {
		$host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
	}

	function hook_article_filter($article) {

		if (strpos($article["guid"], "www.stuttmann-karikaturen.de") !== FALSE) {
			if (strpos($article["plugin_data"], "stuttmann,$owner_uid:") === FALSE) {
				$article["content"] = str_replace("/thumbs/", "/", $article["content"]);
				$article["plugin_data"] = "stuttmann,$owner_uid:" . $article["plugin_data"];
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

