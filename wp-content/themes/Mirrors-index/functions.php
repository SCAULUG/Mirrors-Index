<?php
//关闭谷歌字体
function remove_open_sans() {
wp_deregister_style('open-sans');
wp_register_style('open-sans', false );
wp_enqueue_style('open-sans',”);
}
add_action( 'init', 'remove_open_sans' );

//移除WordPress后台链接
function remove_admin_menus(){
	remove_menu_page('index.php');                  //Dashboard
	remove_menu_page('edit-comments.php');          //Comments
	remove_menu_page('plugins.php');                //Plugins
	remove_menu_page('tools.php');                  //Tools
	remove_menu_page('edit.php?post_type=fmemailverification');                              
	remove_submenu_page('options-general.php', 'options-media.php');
	remove_submenu_page('options-general.php', 'options-discussion.php');
	remove_submenu_page('options-general.php', 'options-reading.php');
	remove_submenu_page('options-general.php', 'options-writing.php');
}
add_action( 'admin_menu', 'remove_admin_menus' );

// 注册主导航菜单
if (function_exists('register_nav_menu')) {
register_nav_menu('main_nav_menu', '主导航菜单');
}
// 创建metabox
$tb_meta_boxes =
array(
    "xtitle" => array(
        "name" => "xtitle",
        "std" => "如果是镜像源分类，请填写，否则无须理会",
        "title" => "镜像名字:") ,
    "url" => array(
        "name" => "url",
        "std" => "例如：/ubuntu/",
        "title" => "镜像地址:") 
);

function tb_meta_boxes() {
    global $post, $tb_meta_boxes;
    foreach($tb_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
        if($meta_box_value == ""){
            $meta_box_value = $meta_box['std'];
        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
        // 若之前信息框为空，则显示提示信息
        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';
        // 自定义字段输入框
        echo '<input class="input-info" style="width:100%" cols="180" rows="3" name="'.$meta_box['name'].'_value" placeholder='.$meta_box_value.' value=""></input><br />';
        }else{
            // 若之前信息框有输入值则保留原值
            // 自定义字段标题
            echo'<h4>'.$meta_box['title'].'</h4>';
            // 自定义字段输入框
            echo '<input class="input-info" style="width:100%" cols="180" rows="3" name="'.$meta_box['name'].'_value" value='.$meta_box_value.'></input><br />';
        }
            
    }
}

function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'tb_meta_boxes', '镜像信息', 'tb_meta_boxes', 'post', 'advanced', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $tb_meta_boxes;
    foreach($tb_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }
        $data = $_POST[$meta_box['name'].'_value'];
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
add_theme_support( "post-thumbnails" );

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

function pagenav($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;
$next = $paged + 1;
$range = 4; // only edit this if you want to show more page-links
$showitems = ($range * 2)+1;

$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
echo "<div class='row content page'>";

for ($i=1; $i <= $pages; $i++){
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
echo ($paged == $i)? "<li><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
}
}
echo "</div>\n";
}
}


?>