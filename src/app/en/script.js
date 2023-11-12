let languageSelectorField = document.querySelector('.language-selector-field');
let languageSelectorTint = document.querySelector('.language-selector-tint');

function getCookie(key) {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${key}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

window.onload = () => {
	switch (getCookie('preferred-language')) {
		case 'dutch':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'french':
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
		case 'english':
			break;
		default:
			languageSelectorField.classList.remove('language-selected');
			languageSelectorTint.classList.remove('language-selected');
			break;
	}
};

function languageSelect(id, depth, currentPage) {
	document.cookie = `preferred-language=${id}` + ';path=/';
	switch (getCookie('preferred-language')) {
		case 'dutch':
			window.location.replace(`${depth}/nl${currentPage}`);
			break;
		case 'french':
			window.location.replace(`${depth}/fr${currentPage}`);
			break;
		case 'english':
			languageSelectorField.classList.add('language-selected');
			languageSelectorTint.classList.add('language-selected');
			break;
		default:
			break;
	}
}

function languageReselect() {
	document.cookie =
		'preferred-language=' +
		';path=/' +
		';expires=Thu, 01 Jan 1970 00:00:01 GMT';
	languageSelectorField.classList.remove('language-selected');
	languageSelectorTint.classList.remove('language-selected');
}
