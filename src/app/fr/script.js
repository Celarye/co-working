let languageSelectorField = document.querySelector('.language-selector-field');
let languageSelectorTint = document.querySelector('.language-selector-tint');

window.onload = () => {
	switch (document.cookie) {
		case 'preferred-language=dutch':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'preferred-language=french':
			break;
		case 'preferred-language=english':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		default:
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
	}
};

function languageSelect(id, depth, currentPage) {
	document.cookie = `preferred-language=${id}` + ';path=/';
	console.log('depth: ', depth);
	console.log('currentPage: ', currentPage);
	switch (document.cookie) {
		case 'preferred-language=dutch':
			window.location.replace(`${depth}/nl${currentPage}`);
			break;
		case 'preferred-language=french':
			languageSelectorField.classList.add('language-selected');
			languageSelectorTint.classList.add('language-selected');
			break;
		case 'preferred-language=english':
			window.location.replace(`${depth}/en${currentPage}`);
			break;
		default:
			break;
	}
}

function languageReselect() {
	document.cookie =
		document.cookie + ';path=/' + ';expires=Thu, 01 Jan 1970 00:00:01 GMT';
	languageSelectorField.classList.remove('language-selected');
	languageSelectorTint.classList.remove('language-selected');
}
