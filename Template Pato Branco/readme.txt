=== Pato Branco ===

Contribuição: Felipe Catani, Satil Pereira
Requires at least: 4.7
Tested up to: 5.9
Stable tag: 2.6.1
Version: 2.6.1
Requires PHP: 5.6
License: GNU General Public License v3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Template para uso em portais da prefeitura municipal de Pato Branco, Escrito para Elementor for Wordpress

== Descrição ==

Este template foi elaborado visando padronização dos portais, e seguindo diretrizes legais para orgãos publicos.
Criado exclusivamente para a Prefeitura de Pato Branco.

Projeto coordenado: Felipe Catani
Contribuição: Satil Pereira


== Personalizações ==

A maioria dos usuários não precisará editar os arquivos para personalizar este tema.
Para personalizar a aparência do seu site, basta usar ***Elementor***.

No entanto, se você tem uma necessidade particular de adaptar este tema, por favor continue lendo.

= Style & Stylesheets =

Todos os estilos do seu site devem ser manuseados diretamente dentro de ***Elementor***.
Você não deve editar os arquivos SCSS neste tema em circunstâncias comuns.

No entanto, se por algum motivo ainda houver a necessidade de adicionar ou alterar o CSS do site, por favor, use um tema novo.

= Hooks =

Para evitar o carregamento de qualquer uma dessas configurações, use o seguinte como caldeira e adicione o código ao seu novo tema `functions.php`:
```php
add_filter( 'choose-from-the-list-below', '__return_false' );
```

* `pato_branco_enqueue_style`                 enqueue style
* `pato_branco_enqueue_theme_style`           load theme-specific style (default: load)
* `pato_branco_load_textdomain`               load theme's textdomain
* `pato_branco_register_menus`                register the theme's default menu location
* `pato_branco_add_theme_support`             register the various supported features
* `pato_branco_add_woocommerce_support`       register woocommerce features, including product-gallery zoom, swipe & lightbox features
* `pato_branco_register_elementor_locations`  register elementor settings
* `pato_branco_content_width`                 set default content width to 800px
* `pato_branco_page_title`                    show\hide page title (default: show)
* `pato_branco_viewport_content`              modify `content` of `viewport` meta in header


== Copyright ==

Este tema, como wordpress, é licenciado sob o GPL.

Este template foi feito para uso com Elementor e reúne os seguintes recursos de terceiros:

Font Awesome icons for theme screenshot
License: SIL Open Font License, version 1.1.
Source: https://fontawesome.com/v4.7.0/

== Changelog ==
