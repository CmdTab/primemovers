function lastItem() {
	jQuery('.three-list li:last-child, .three-list li:nth-child(3n), .testimony-excerpt:odd').addClass('last');
}

jQuery(document).ready(function() {
	lastItem();
});