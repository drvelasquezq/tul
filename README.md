<div class="collection-description">
<h3 class="description" style="text-align: left;"><strong>Cat&aacute;logo de productos sencillo, exponiendo una API desde Laravel para TUL</strong></h3>
<div class="description" style="text-align: left;">&nbsp;</div>
<div class="description" style="text-align: left;">
<div class="description" style="text-align: left;"><strong>El siguiente es un corto v&iacute;deo que intenta mostrar como utilizar la API relacionado con la guia:</strong></div>
<div class="description" style="text-align: left;"><strong><a href="https://www.youtube.com/watch?v=ZYy70_Stm9Q" target="_blank" rel="noopener">https://www.youtube.com/watch?v=ZYy70_Stm9Q</a></strong></div>
</div>
<div class="description" style="text-align: left;">&nbsp;</div>
<div class="description" style="text-align: left;"><strong>URL en la que se proporciona la informaci&oacute;n necesaria para consumir la API (gu&iacute;a):</strong></div>
<div class="description" style="text-align: left;"><strong> <a href="https://documenter.getpostman.com/view/15089643/TzJyaacX" target="_blank">https://documenter.getpostman.com/view/15089643/TzJyaacX</a><br /></strong></div>
<div class="description" style="text-align: left;">&nbsp;</div>
<div class="description" style="text-align: left;">Puede utilizar <span style="color: #ff0000;"><strong><a href="https://prueba-tul.herokuapp.com">https://prueba-tul.herokuapp.com</a></strong> <span style="color: #000000;">(este servidor duerme, en la primer petici&oacute;n por favor esperar unos 30 segundos, en las siguientes peticiones ya estar&aacute; despierto y responder&aacute; m&aacute;s r&aacute;pido)</span> <span style="color: #000000;">en vez de su <span style="color: #ff0000;">{{host}} o <a href="http://127.0.0.1:8000,">http://127.0.0.1:8000</a><span style="color: #000000;">, </span><span style="color: #000000;">esto hace que no se tenga la necesidad de instalar o crear una instancia de la API si no lo desea, por ejemplo: <a href="https://prueba-tul.herokuapp.com/catalogue" target="_blank">https://prueba-tul.herokuapp.com/catalogue</a></span></span></span></span></div>
<div class="description" style="text-align: left;">&nbsp;</div>
<h3 class="description" style="text-align: left;"><strong>Prueba Laravel</strong></h3>
<div class="description" style="text-align: left;">Esta prueba consiste en realizar un cat&aacute;logo de productos sencillo, exponiendo un API desde Laravel, donde la funcionalidad requerida ser&aacute;:</div>
<ol>
<li class="description" style="text-align: left;">Los productos disponibles deben contener:&nbsp;<strong>imagen, sku, nombre, descripci&oacute;n, categor&iacute;a, stock y precio.</strong></li>
<li class="description" style="text-align: left;">Los productos pueden ser agregados a un carrito, que llevar&aacute; el<strong>total a pagar, total de referencias y total de productos.</strong></li>
<li class="description" style="text-align: left;"><span lang="EN">Las categor&iacute;as deber&aacute;n de tener 2 niveles: categor&iacute;a principal y categor&iacute;a hija.</span><strong><span lang="EN">Solo en la hija se pueden asignar los productos.</span></strong></li>
<li class="description" style="text-align: left;"><span lang="EN">Las categor&iacute;as deber&aacute;n tener:&nbsp;</span><strong><span lang="EN">nombre y estado</span></strong><span lang="EN">&nbsp;(activo/inactivo).</span></li>
</ol>
<div class="description" style="text-align: left;"><strong><span lang="EN">Las funcionalidades esperadas son:</span></strong></div>
<ul>
<li class="description" style="text-align: left;"><span lang="EN">Los productos se mostrar&aacute;n en el cat&aacute;logo siempre y cuando el stock sea mayor a 0, la categor&iacute;a del producto est&eacute; activa (tanto la padre como la hija) y el precio sea mayor a 0.</span></li>
<li class="description" style="text-align: left;"><span lang="EN">Se pueden agregar, eliminar o modificar productos al carrito.</span></li>
<li class="description" style="text-align: left;"><span lang="EN">&nbsp;Al agregar un producto al carrito y este supere la cantidad disponible, autom&aacute;ticamente colocarle la cantidad disponible.</span></li>
<li class="description" style="text-align: left;"><span lang="EN">El stock debe de descontarse al confirmar la compra.</span></li>
<li class="description" style="text-align: left;"><span lang="EN">Al llegar un producto a 0 de stock, ya no aparecer&aacute; en el cat&aacute;logo.</span></li>
</ul>
<div class="description" style="text-align: left;"><strong><span lang="EN">Tecnolog&iacute;a requerida:</span></strong> Laravel 7+</div>
<div class="description" style="text-align: left;">&nbsp;</div>
<div class="description" style="text-align: left;">&nbsp;</div>
<h3 class="description" style="text-align: left;"><strong>A continuaci&oacute;n se dejan aspectos o caracter&iacute;sticas consideradas importantes</strong></h3>
</div>
<ul>
<li>Creaci&oacute;n de las tablas y sus relaciones: <a href="https://www.youtube.com/watch?v=QgW-zDsIPpg" target="_blank">https://www.youtube.com/watch?v=QgW-zDsIPpg</a></li>
<li>Instalaci&oacute;n de una instancia del proyecto: <a href="https://www.youtube.com/watch?v=ULWc07cMnVg" target="_blank">https://www.youtube.com/watch?v=ULWc07cMnVg</a> En caso de no tener un interprete de php y que reciba las peticiones: luego de ejecutar los pasos escribir el comando <strong>php artisan serve - </strong>este devolver&aacute; un host valido y funcional como <a href="http://127.0.0.1:8000,">http://127.0.0.1:8000</a>. Si el servicio de AWS falla se asignar&aacute; una imagen de producto aleatoria (puede solicitar acesos para que esto no suceda de ser necesario).</li>
<li>Pruebas unitarias: <a href="https://www.youtube.com/watch?v=K4pwd-FQqCc" target="_blank">https://www.youtube.com/watch?v=K4pwd-FQqCc</a></li>
</ul>
<p>(&gt;‿◠)✌🚀</p>
