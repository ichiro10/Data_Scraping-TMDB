<?php
require_once('vendor/dg/rss-php/src/Feed.php');

$url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";

$rss = Feed::loadRss($url);

echo 'Title: ', $rss->title."<br>"."<br>";

echo 'Description: ', $rss->description."<br>"."<br>";

echo 'Link: ', $rss->url."<br>"."<br>";

?>

<html>
	<body>
		<table>
			<?php
			foreach ($rss->item as $item) {
				echo '<tr>';
				echo '<td>Title: ',"<a href=$item->link . </a>", $item->title, '</td>';
				echo '<td>Date: ', date('d/m/Y H:i:s',intval($item->timestamp)), '</td>';
				echo '<td>Durée: ', $item->{'itunes:duration'}, '</td>';
				echo '<td> ',"<audio controls src={$item->enclosure->attributes()['url']} />", '</td>';
				echo '<td>',"<a href={$item->enclosure->attributes()['url']} download>Télécharger</a>",  '</td>';
				echo '</tr>';
			}
			?>
		</table>
	</body>
</html>
