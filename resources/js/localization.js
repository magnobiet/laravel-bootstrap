import portugueseBrazil from './../lang/pt-BR.json';

export const dictionary = {
	'pt-BR': portugueseBrazil
};

export const locale = $('html').attr('lang');

export const __ = (key) => dictionary[locale][key] ? dictionary[locale][key] : key;
