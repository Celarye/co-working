let languageSelectorField = document.querySelector('.language-selector-field');
let languageSelectorTint = document.querySelector('.language-selector-tint');

window.onload = () => {
	switch (document.cookie) {
		case 'preferred-language=dutch':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'preferred-language=french':
			languageSelectorField.classList.add('language-selected');
			languageSelectorTint.classList.add('language-selected');
			break;
		case 'preferred-language=english':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		default:
			break;
	}
};

function languageSelect(id) {
	document.cookie = `preferred-language=${id}` + ';path=/';
	switch (document.cookie) {
		case 'preferred-language=dutch':
			window.location.replace('../');
			break;
		case 'preferred-language=english':
			window.location.replace('../en');
			break;
		default:
			break;
	}
	languageSelectorField.classList.add('language-selected');
	languageSelectorTint.classList.add('language-selected');
}

function languageReselect() {
	document.cookie =
		document.cookie + ';path=/' + ';expires=Thu, 01 Jan 1970 00:00:01 GMT';
	languageSelectorField.classList.remove('language-selected');
	languageSelectorTint.classList.remove('language-selected');
}
