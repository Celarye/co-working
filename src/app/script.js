window.onload = () => {
	switch (document.cookie) {
		case 'preferred-language=dutch':
			window.location.replace('./nl');
			break;
		case 'preferred-language=french':
			window.location.replace('./fr');
			break;
		case 'preferred-language=english':
			window.location.replace('./en');
			break;
		default:
			window.location.replace('./nl');
			break;
	}
};
