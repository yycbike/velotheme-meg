sassify:
	sass -s compressed sass/style.scss style.css

shrinkcss:
	postcss sass_style.css >style.css

css: sassify
	# We need to add the header comment so WP knows which parent theme to use
	cat css_header.css style.css > style.css.new
	mv style.css.new style.css
