let languageSelectorField = document.querySelector('.language-selector-field');
let languageSelectorTint = document.querySelector('.language-selector-tint');

window.onload = () => {
	switch (document.cookie) {
		case 'preferred-language=dutch':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'preferred-language=french':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'preferred-language=english':
			break;
		default:
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
	}
};

function languageSelect(id, depth, currentPage) {
	document.cookie = `preferred-language=${id}` + ';path=/';
	switch (document.cookie) {
		case 'preferred-language=dutch':
			window.location.replace(`${depth}/nl${currentPage}`);
			break;
		case 'preferred-language=french':
			window.location.replace(`${depth}/fr${currentPage}`);
			break;
		case 'preferred-language=english':
			languageSelectorField.classList.add('language-selected');
			languageSelectorTint.classList.add('language-selected');
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
