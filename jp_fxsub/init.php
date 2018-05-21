<?php
/**
 * Add register TT-RSS as a reader in Firefox
 *
 * PHP version 5
 *
 * @author  Jeena <hello@jeena.net>
 * @license AGPLv3 or later
 * @link    https://developer.mozilla.org/en-US/Firefox/Releases/2/Adding_feed_readers_to_Firefox
 */
class Jp_Fxsub extends Plugin
{
    public function about()
    {
        return [
            1.0,
            'Add register TT-RSS as a reader in Firefox',
            'Jeena',
            false
        ];
    }

    public function api_version()
    {
        return 2;
    }


    /**
     * Register our hooks
     */
    public function init(/*PluginHost*/ $host)
    {
        $host->add_hook($host::HOOK_PREFS_TAB, $this);
    }

    /**
     * Render our configuration page.
     * Directly echo it out.
     *
     * @param string $args Preferences tab that is currently open
     *
     * @return void
     */
    public function hook_prefs_tab($args)
    {
        if ($args != "prefPrefs") {
            return;
        }

	if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") !== false) {
		?><div dojoType="dijit.layout.AccordionPane" title="Firefox integration"><?php
		print_notice(__('This Tiny Tiny RSS site can be used as a Firefox Feed Reader by clicking the link below.'));
		?>
			<p>
				<button onclick='window.navigator.registerContentHandler("application/vnd.mozilla.maybe.feed", "<?php echo get_self_url_prefix() ?>/public.php?op=subscribe&feed_url=%s", "Tiny Tiny RSS")'>
						Click here to register this site as a feed reader.
				</button>
			</p>
		</div><?php
	}
    }

}

