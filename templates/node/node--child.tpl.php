<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>
<?php if($teaser): ?>
<article id="node-<?php print $node->nid; ?>" class="thumbnail thumbnail-child"<?php print $attributes; ?>>
    <?php print render($content['field_profile_picture']); ?>
    <div class="caption">
        <?php
        // Hide comments, tags, and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_tags']);
        hide($content['field_image']);
        print render($content);
        ?>
        <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
            <header>
                <?php print render($title_prefix); ?>
                <?php if (!$page && !empty($title)): ?>
                    <h2<?php print $title_attributes; ?> class="text-center"><a href="<?php print $node_url; ?>">Apadrina a <?= $child_name; ?>, 6 años</a></h2>
                <?php endif; ?>
                <?php print render($title_suffix); ?>
                <?php if ($display_submitted): ?>
                    <span class="submitted">
                      <?php print $user_picture; ?>
                      <?php print $submitted; ?>
                    </span>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
            <footer>
                <p class="text-center"><a href="" class="btn btn-primary">Cambia mi vida ahora</a></p>
                <?php print render($content['field_tags']); ?>
                <?php print render($content['links']); ?>
            </footer>
        <?php endif; ?>
        <?php print render($content['comments']); ?>
    </div>
</article>
<?php else: ?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    
    <div class="row">
        <div class="col-sm-4">
            <div class="child-thumbnail">
                <?php print render($content['flippy_pager']); ?>
                <img class="img-circle" src="<?= file_create_url($child->field_profile_picture->value()['uri']); ?>" alt="">
                <?php print render($content['flippy_pager']); ?>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="child-summary">
                <h2 class="hidden-xs">Hola, me llamo <span class="child-name"><?= $child_name; ?></span></h2>
                <h2 class="visible-xs brand">Apadrina a <?= $child_name; ?></h2>
                <ul class="list-inline text-center">
                    <li>
                        <span class="child-summary-attr">Sexo</span>
                        <span class="child-summary-val">
                            <?= $child_gender ?>
                        </span>
                    </li>
                    <li>
                        <span class="child-summary-attr">Edad</span>
                        <span class="child-summary-val">
                            <?= $child_age ?>
                        </span>
                    </li>
                    <li>
                        <span class="child-summary-attr">Vivo en</span>
                        <span class="child-summary-val">
                            <?= $child_country; ?>
                        </span>
                    </li>
                </ul>
                <blockquote class="child-soliloquy">
                    <p>
                        Mi cumpleaños es el <?= $child_birthday; ?> y
                        <?php if($child_brothers and $child_sisters): ?>
                            tengo <?= $child_brothers ?> hermano<?= $child_brothers > 1 ? 's' : '' ?> y <?= $child_sisters; ?> hermana<?= $child_sisters > 1 ? 's' : '' ?>.
                        <?php elseif ($child_brothers): ?>
                            tengo <?= $child_brothers ?> hermanos.
                        <?php elseif ($child_sisters): ?>
                            tengo <?= $child_sisters ?> hermanas.
                        <?php else: ?>
                            no tengo hermanos ni hermanas.
                        <?php endif; ?>
                        Mi juego favorito es <?= $child_favourite_play; ?>. La vida en <?= $child_country; ?> es difícil para l<?= $child_gender == 'Chico' ? 'o' : 'a' ?>s niñ<?= $child_gender == 'Chico' ? 'o' : 'a' ?>s como yo pero si me apadrinas hoy mi vida cambiará y tendré un futuro mejor.
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center"><a href="/tu-apadrinamiento/<?= $product_id ?>" class="btn btn-primary btn-large">Apadrina a <?= $child_name ?> ahora</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="video-container">
                <div class="arrow-down hidden-xs"></div>
                <div class="embed-responsive embed-responsive-4by3">
                    <?php if(! empty($child->field_greetings_video->value())): ?>
                    <video class="embed-responsive-item" controls>
                        <source src="<?= file_create_url($child->field_greetings_video->value()['uri']); ?>" type="video/mp4" /><!-- Safari / iOS video    -->
                        <source src="__VIDEO__.OGV" type="video/ogg" /><!-- Firefox / Opera / Chrome10 -->
                        <!-- fallback to Flash: -->
                        <object width="640" height="360" type="application/x-shockwave-flash" data="__FLASH__.SWF">
                            <!-- Firefox uses the `data` attribute above, IE/Safari uses the param below -->
                            <param name="movie" value="__FLASH__.SWF" />
                            <param name="flashvars" value="controlbar=over&amp;image=__POSTER__.JPG&amp;file=__VIDEO__.MP4" />
                            <!-- fallback image. note the title field below, put the title of the video there -->
                            <img src="/sites/all/themes/gaea/node__child/america.JPG" width="640" height="360" alt="__TITLE__"
                                 title="No video playback capabilities, please download the video below" />
                        </object>
                    </video>
                    <?php elseif($child_country == "Guatemala" || $child_country == "Bolivia"): ?>
                    <img class="img-responsive" src="/sites/all/themes/gaea/img/node__child/america.JPG" alt="">
                        <?php elseif($child_country == "Zimbabwe" || $child_country == "Ghana" || $child_country == "Mali"): ?>
                        <img class="img-responsive" src="/sites/all/themes/gaea/img/node__child/africa.jpg" alt="">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- This Is My World -->
    <div class="row">
        <div class="col-xs-12">
            <!-- <div class="clock">2:06<span>pm</span></div> -->

            <h2>Vivo en <?= $child_country; ?></h2>

	        <p class="lead text-center">Vivo junto a  mi familia en una comunidad de <?= $child_country ?> uno de los países más pobres de <?= $child_continent ?>. Aquí la falta de agua potable provoca que los niños tengamos graves enfermedades diarreicas y respiratorias.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center"><a href="/tu-apadrinamiento/<?= $product_id ?>" class="btn btn-primary btn-large">Apadrina a <?= $child_name ?> ahora</a></p>
        </div>
    </div>

    <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
        <footer>
            <?php print render($content['field_tags']); ?>
            <?php print render($content['links']); ?>
        </footer>
    <?php endif; ?>
</article>
<?php endif; ?>
