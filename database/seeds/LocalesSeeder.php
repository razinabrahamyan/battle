<?php

use App\Locales;
use Illuminate\Database\Seeder;

class LocalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Abkhazian',	                'short' => 'ab'],
            ['name' => 'Afar',	                    'short' => 'aa'],
            ['name' => 'Afrikaans',	                'short' => 'af'],
            ['name' => 'Akan',	                    'short' => 'ak'],
            ['name' => 'Albanian',	                'short' => 'sq'],
            ['name' => 'Amharic',	                'short' => 'amh'],
            ['name' => 'Arabic',	                'short' => 'ar'],
            ['name' => 'Aragonese',	                'short' => 'an'],
            ['name' => 'Armenian',	                'short' => 'am'],
            ['name' => 'Assamese',	                'short' => 'as'],
            ['name' => 'Avaric',	                'short' => 'av'],
            ['name' => 'Avestan',	                'short' => 'ae'],
            ['name' => 'Aymara',	                'short' => 'ay'],
            ['name' => 'Azerbaijani',	            'short' => 'az'],
            ['name' => 'Bambara',	                'short' => 'bm'],
            ['name' => 'Bashkir',	                'short' => 'ba'],
            ['name' => 'Basque',	                'short' => 'eu'],
            ['name' => 'Belarusian',	            'short' => 'be'],
            ['name' => 'Bengali (Bangla)',          'short' => 'bn'],
            ['name' => 'Bihari',	                'short' => 'bh'],
            ['name' => 'Bislama',	                'short' => 'bi'],
            ['name' => 'Bosnian',	                'short' => 'bs'],
            ['name' => 'Breton',	                'short' => 'br'],
            ['name' => 'Bulgarian',	                'short' => 'bg'],
            ['name' => 'Burmese',	                'short' => 'my'],
            ['name' => 'Catalan',	                'short' => 'ca'],
            ['name' => 'Chamorro',	                'short' => 'ch'],
            ['name' => 'Chechen',	                'short' => 'ce'],
            ['name' => 'Chichewa, Chewa, Nyanja',   'short' => 'ny'],
            ['name' => 'Chinese',            	    'short' => 'zh'],
            ['name' => 'Chinese (Simplified)',	    'short' => 'zh-Hans'],
            ['name' => 'Chinese (Traditional)',	    'short' => 'zh-Hant'],
            ['name' => 'Chuvash',            	    'short' => 'cv'],
            ['name' => 'Cornish',            	    'short' => 'kw'],
            ['name' => 'Corsican',           	    'short' => 'co'],
            ['name' => 'Cree',               	    'short' => 'cr'],
            ['name' => 'Croatian',           	    'short' => 'hr'],
            ['name' => 'Czech',              	    'short' => 'cs'],
            ['name' => 'Danish',             	    'short' => 'da'],
            ['name' => 'Divehi, Dhivehi, Maldivian','short' => 'dv'],
            ['name' => 'Dutch',	                    'short' => 'nl'],
            ['name' => 'Dzongkha',                  'short' => 'dz'],
            ['name' => 'English',                   'short' => 'en'],
            ['name' => 'Esperanto',              	'short' => 'eo'],
            ['name' => 'Estonian',                  'short' => 'et'],
            ['name' => 'Ewe',	                    'short' => 'ee'],
            ['name' => 'Faroese',                	'short' => 'fo'],
            ['name' => 'Fijian',             	    'short' => 'fj'],
            ['name' => 'Finnish',                	'short' => 'fi'],
            ['name' => 'French',	                'short' => 'fr'],
            ['name' =>'Fula, Fulah, Pulaar, Pular',	'short' => 'ff'],
            ['name' =>'Galician',	                'short' => 'gl'],
            ['name' =>'Gaelic (Scottish)',	        'short' => 'gd'],
            ['name' =>'Gaelic (Manx)',	            'short' => 'gv'],
            ['name' =>'Georgian',	                'short' => 'ka'],
            ['name' =>'German',	                    'short' => 'de'],
            ['name' =>'Greek',	                    'short' => 'el'],
            ['name' =>'Greenlandic',	            'short' => 'kl'],
            ['name' =>'Guarani',                    'short' => 'gn'],
            ['name' =>'Gujarati',                   'short' => 'gu'],
            ['name' =>'Haitian Creole',	            'short' => 'ht'],
            ['name' =>'Hebrew',                     'short' => 'he'],
            ['name' =>'Hausa',	                    'short' => 'ha'],
            ['name' =>'Herero',                     'short' => 'hz'],
            ['name' =>'Hindi',                      'short' => 'hi'],
            ['name' =>'Hiri Motu',                  'short' => 'ho'],
            ['name' =>'Hungarian',                  'short' => 'hu'],
            ['name' =>'Icelandic',                  'short' => 'is'],
            ['name' =>'Ido',                        'short' => 'io'],
            ['name' =>'Igbo',                       'short' => 'ig'],
            ['name' =>'Indonesian',                 'short' => 'id'],
            ['name' =>'Interlingua',                'short' => 'ia'],
            ['name' =>'Interlingue',                'short' => 'ie'],
            ['name' =>'Inuktitut',                  'short' => 'iu'],
            ['name' =>'Inupiak',                    'short' => 'ik'],
            ['name' =>'Irish',                      'short' => 'ga'],
            ['name' =>'Italian',                    'short' => 'it'],
            ['name' =>'Japanese',                   'short' => 'ja'],
            ['name' =>'Javanese',                   'short' => 'jv'],
            ['name' =>'Kalaallisut, Greenlandic',   'short' => 'kl'],
            ['name' =>'Kannada',                    'short' => 'kn'],
            ['name' =>'Kanuri',                     'short' => 'kr'],
            ['name' =>'Kashmiri',                   'short' => 'ks'],
            ['name' =>'Kazakh',                     'short' => 'kk'],
            ['name' =>'Khmer',                      'short' => 'km'],
            ['name' =>'Kikuyu',                     'short' => 'ki'],
            ['name' =>'Kinyarwanda (Rwanda)	',      'short' => 'rw'],
            ['name' =>'Kirundi	 ',                 'short' => 'rn'],
            ['name' =>'Kyrgyz	 ',                 'short' => 'ky'],
            ['name' =>'Komi	     ',                 'short' => 'kv'],
            ['name' =>'Kongo	 ',                 'short' => 'kg'],
            ['name' =>'Korean	 ',                 'short' => 'ko'],
            ['name' =>'Kurdish	 ',                 'short' => 'ku'],
            ['name' =>'Kwanyama	 ',                 'short' => 'kj'],
            ['name' =>'Lao	     ',                 'short' => 'lo'],
            ['name' =>'Latin	 ',                 'short' => 'la'],
            ['name' =>'Latvian (Lettish)',          'short' => 'lv'],
            ['name' =>'Limburgish ( Limburger)',    'short' => 'li'],
            ['name' =>'Lingala	   ',               'short' => 'ln'],
            ['name' =>'Lithuanian	   ',           'short' => 'lt'],
            ['name' =>'Luga-Katanga	   ',           'short' => 'lu'],
            ['name' =>'Luganda, Ganda',             'short' => 'lg'],
            ['name' =>'Luxembourgish',              'short' => 'lb'],
            ['name' =>'Manx	     ',                 'short' => 'gv'],
            ['name' =>'Macedonian',                 'short' => 'mk'],
            ['name' =>'Malagasy	 ',                 'short' => 'mg'],
            ['name' =>'Malay	 ',                 'short' => 'ms'],
            ['name' =>'Malayalam ',                 'short' => 'ml'],
            ['name' =>'Maltese	 ',                 'short' => 'mt'],
            ['name' =>'Maori	 ',                 'short' => 'mi'],
            ['name' =>'Marathi	 ',                 'short' => 'mr'],
            ['name' =>'Marshallese',                'short' => 'mh'],
            ['name' =>'Moldavian',                  'short' => 'mo'],
            ['name' =>'Mongolian',                  'short' => 'mn'],
            ['name' =>'Nauru	 ',                 'short' => 'na'],
            ['name' =>'Navajo	 ',                 'short' => 'nv'],
            ['name' =>'Ndonga	 ',                 'short' => 'ng'],
            ['name' =>'Northern Ndebele',	        'short' => 'nd'],
            ['name' =>'Nepali',	                    'short' => 'ne'],
            ['name' =>'Norwegian',	                'short' => 'no'],
            ['name' =>'Norwegian bokmål	  ',        'short' => 'nb'],
            ['name' =>'Norwegian nynorsk',	        'short' => 'nn'],
            ['name' =>'Nuosu',                      'short' => 'ii'],
            ['name' =>'Occitan',                    'short' => 'oc'],
            ['name' =>'Ojibwe',	                    'short' => 'oj'],
            ['name' =>'Oriya',	                    'short' => 'or'],
            ['name' =>'Oromo (Afaan Oromo)',	    'short' => 'om'],
            ['name' =>'Ossetian	      ',            'short' => 'os'],
            ['name' =>'Pāli	          ',            'short' => 'pi'],
            ['name' =>'Pashto, Pushto',             'short' => 'ps'],
            ['name' =>'Persian (Farsi)',            'short' => 'fa'],
            ['name' =>'Polish	      ',            'short' => 'pl'],
            ['name' =>'Portuguese	  ',            'short' => 'pt'],
            ['name' =>'Punjabi (Eastern)',	        'short' => 'pa'],
            ['name' =>'Quechua	',                  'short' => 'qu'],
            ['name' =>'Romansh	',                  'short' => 'rm'],
            ['name' =>'Romanian	',                  'short' => 'ro'],
            ['name' =>'Russian	',                  'short' => 'ru'],
            ['name' =>'Sami	   ',                   'short' => 'se'],
            ['name' =>'Samoan',                     'short' => 'sm'],
            ['name' =>'Sango',                      'short' => 'sg'],
            ['name' =>'Sanskrit	',                  'short' => 'sa'],
            ['name' =>'Serbian	',                  'short' => 'sr'],
            ['name' =>'Serbo-Croatian',             'short' => 'sh'],
            ['name' =>'Sesotho',                    'short' => 'st'],
            ['name' =>'Setswana',                   'short' => 'tn'],
            ['name' =>'Shona	   ',               'short' => 'sn'],
            ['name' =>'Sichuan Yi',                 'short' => 'ii'],
            ['name' =>'Sindhi	   ',               'short' => 'sd'],
            ['name' =>'Sinhalese',                  'short' => 'si'],
            ['name' =>'Siswati	   ',               'short' => 'ss'],
            ['name' =>'Slovak	   ',               'short' => 'sk'],
            ['name' =>'Slovenian',	                'short' => 'sl'],
            ['name' =>'Somali	   ',               'short' => 'so'],
            ['name' =>'Southern Ndebele',           'short' => 'nr'],
            ['name' =>'Spanish	       ',           'short' => 'es'],
            ['name' =>'Sundanese	   ',           'short' => 'su'],
            ['name' =>'Swahili (Kiswahili)',        'short' => 'sw'],
            ['name' =>'Swati',                      'short' => 'ss'],
            ['name' =>'Swedish',                    'short' => 'sv'],
            ['name' =>'Tagalog',                    'short' => 'tl'],
            ['name' =>'Tahitian',                   'short' => 'ty'],
            ['name' =>'Tajik',                      'short' => 'tg'],
            ['name' =>'Tamil',                      'short' => 'ta'],
            ['name' =>'Tatar',                      'short' => 'tt'],
            ['name' =>'Telugu',                     'short' => 'te'],
            ['name' =>'Thai	  ',                    'short' => 'th'],
            ['name' =>'Tibetan',                    'short' => 'bo'],
            ['name' =>'Tigrinya	  ',                'short' => 'ti'],
            ['name' =>'Tonga',                      'short' => 'to'],
            ['name' =>'Tsonga',                     'short' => 'ts'],
            ['name' =>'Turkish',                    'short' => 'tr'],
            ['name' =>'Turkmen',                    'short' => 'tk'],
            ['name' =>'Twi	 ',                     'short' => 'tw'],
            ['name' =>'Uyghur',                     'short' => 'ug'],
            ['name' =>'Ukrainian  ',                'short' => 'uk'],
            ['name' =>'Urdu',                       'short' => 'ur'],
            ['name' =>'Uzbek',                      'short' => 'uz'],
            ['name' =>'Venda',                      'short' => 've'],
            ['name' =>'Vietnamese',                 'short' => 'vi'],
            ['name' =>'Volapük',                    'short' => 'vo'],
            ['name' =>'Wallon',                     'short' => 'wa'],
            ['name' =>'Welsh',                      'short' => 'cy'],
            ['name' =>'Wolof',                      'short' => 'wo'],
            ['name' =>'Western Fris',               'short' => 'fy'],
            ['name' =>'Xhosa',                      'short' => 'xh'],
            ['name' =>'Yiddish',                    'short' => 'yi'],
            ['name' =>'Yoruba',                     'short' => 'yo'],
            ['name' =>'Zhuang, Chuang',             'short' => 'za'],
            ['name' =>'Zulu',                       'short' => 'zu'],

        ];

        Locales::insert($data);
    }
}