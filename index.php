require_once 'Torrent.php';

// get torrent infos
$torrent = new Torrent( 'test.torrent' );
echo '<br>private: ', $torrent->is_private() ? 'yes' : 'no', 
	 '<br>annonce: ', $torrent->announce(), 
	 '<br>name: ', $torrent->name(), 
	 '<br>comment: ', $torrent->comment(), 
	 '<br>piece_length: ', $torrent->piece_length(), 
	 '<br>size: ', $torrent->size( 2 ),
	 '<br>hash info: ', $torrent->hash_info(),
	 '<br>stats: ';
var_dump( $torrent->scrape() );
echo '<br>content: ';
var_dump( $torrent->content() );
echo '<br>source: ',
	 $torrent;

// get magnet link
$torrent->magnet(); // use $torrent->magnet( false ); to get non html encoded ampersand

// create torrent
$torrent = new Torrent( array( 'test.mp3', 'test.jpg' ), 'http://torrent.tracker/annonce' );
$torrent->save('test.torrent'); // save to disk

// modify torrent
$torrent->announce('http://alternate-torrent.tracker/annonce'); // add a tracker
$torrent->announce(false); // reset announce trackers
$torrent->announce(array('http://torrent.tracker/annonce', 'http://alternate-torrent.tracker/annonce')); // set tracker(s), it also works with a 'one tracker' array...
$torrent->announce(array(array('http://torrent.tracker/annonce', 'http://alternate-torrent.tracker/annonce'), 'http://another-torrent.tracker/annonce')); // set tiered trackers
$torrent->comment('hello world');
$torrent->name('test torrent');
$torrent->is_private(true);
$torrent->httpseeds('http://file-hosting.domain/path/'); // Bittornado implementation
$torrent->url_list(array('http://file-hosting.domain/path/','http://another-file-hosting.domain/path/')); // GetRight implementation

// print errors
if ( $errors = $torrent->errors() )
	var_dump( $errors );

// send to user
$torrent->send();
