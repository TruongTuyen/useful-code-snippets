<?php
$args = array( 
  
//////Author Parameters - Tham số lấy bài viết theo tác giả
    //http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters
    'author' => '1,2,3,',                     //(int) - Các ID tác giả cần lấy bài viết (thêm dấu - vào để loại trừ tác giả, ví dụ: -14, -20)
    'author_name' => 'luetkemj',              //(string) - Lấy bài viết dựa theo tên nick name của tác giả
    'author__in' => array( 2, 6 ),            //(array) - Lấy bài dựa theo ID của tác giả
    'author__not_in' => array( 2, 6 ),        //(array)' - Các ID của tác giả không muốn lấy bài
  
//////Category Parameters - Tham số lấy bài viết dựa theo category
    //http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
    'cat' => 5,//(int) - Lấy bài dựa theo ID của category
    'category_name' => 'staff, news',          //(string) - Lấy bài dựa theo category slug
    'category__and' => array( 2, 6 ),         //(array) - Lấy bài mà nó mang cả hai category 2 và 6 (ID)
    'category__in' => array( 2, 6 ),          //(array) - ID của các category không muốn lấy bài
    'category__not_in' => array( 2, 6 ),      //(array) - Các ID của category không muốn lấy bài
     
//////Tag Parameters - Tham số lấy bài viết dựa theo tag
    //http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters
    'tag' => 'cooking',                       //(string) - Lấy bài viết theo tag slug
    'tag_id' => 5,                            //(int) - Lấy bài viết theo tag ID
    'tag__and' => array( 2, 6),               //(array) - Lấy bài viết mà nó mang cả hai tag có ID 2 và 6
    'tag__in' => array( 2, 6),                //(array) - Lấy tất cả bài viết trong nhiều tag ID khác nhau
    'tag__not_in' => array( 2, 6),            //(array) - Các tag ID không muốn lấy bài
    'tag_slug__and' => array( 'red', 'blue'), //(array) - Lấy bài viết mà nó mang cả hai tag có slug red và blue
    'tag_slug__in' => array( 'red', 'blue'),  //(array) - Lấy bài viết trong nhiều tag slug khác nhau
  
//////Taxonomy Parameters - Lấy bài viết dựa theo taxonomy
    //http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
    //Quan trọng: tax_query là tham số có thể sẽ chứa nhiều mảng lồng vào bên trong
    'tax_query' => array(                     //(array) - Lấy bài viết dựa theo taxonomy
    'relation' => 'AND',                      //(string) - Mối quan hệ giữa các tham số bên trong, AND hoặc OR
      array(
        'taxonomy' => 'color',                //(string) - Tên của taxonomy
        'field' => 'slug',                    //(string) - Loại field cần xác định term của taxonomy, sử dụng 'id' hoặc 'slug'
        'terms' => array( 'red', 'blue' ),    //(int/string/array) - Slug của các terms bên trong taxonomy cần lấy bài
        'include_children' => true,           //(bool) - Lấy category con, true hoặc false
        'operator' => 'IN'                    //(string) - Toán tử áp dụng cho mảng tham số này. Sử dụng 'IN' hoặc 'NOT IN'
      ),
      array(
        'taxonomy' => 'actor',
        'field' => 'id',
        'terms' => array( 103, 115, 206 ),
        'include_children' => false,
        'operator' => 'NOT IN'
      )
    ),

//////Post & Page Parameters - Lấy bài viết dựa vào tham số của Post hoặc Page
    //http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters
    'p' => 1,                               //(int) - ID của post cần hiển thị
    'name' => 'hello-world',                //(string) - Slug của post cần hiển thị
    'page_id' => 1,                         //(int) - ID của page cần hiển thị
    'pagename' => 'sample-page',            //(string) - Slug của page cần hiển thị
    'pagename' => 'contact_us/canada',      //(string) - Hiển thị page con bằng slug của page mẹ và page con, cách nhau bởi dấu gạch chéo
    'post_parent' => 1,                     //(int) - Lấy page con dựa vào ID của page mẹ
    'post_parent__in' => array(1,2,3)       //(array) - Lấy nhiều page con dựa vào nhiều page mẹ thông qua ID
    'post_parent__not_in' => array(1,2,3),  //(array) - Các ID của page mẹ không muốn hiển thị page con
    'post__in' => array(1,2,3),             //(array) - Danh sách các post cần lấy, dùng ID
    'post__not_in' => array(1,2,3),         //(array) - Danh sách các post không muốn lấy, dùng ID
    //NOTE: Bạn không thể sử dụng 'post__in' cùng với 'post__not_in' trong một query

//////Password Parameters - Lấy các bài viết dựa theo thiết lập mật khẩu của post
    //http://codex.wordpress.org/Class_Reference/WP_Query#Password_Parameters
    'has_password' => true,                 //(bool) - Lấy các bài viết có đặt password
                                              //true bài viết có pass 
                                              //false bài viết không có pass
                                              //null Mặc định nó sẽ lấy toàn bộ post có pass và không có pass
    'post_password' => 'multi-pass',          //(string) - show posts with a particular password (available with Version 3.9)

//////Type - Hiển thị post dựa vào loại post 
    //http://codex.wordpress.org/Class_Reference/WP_Query#Type_Parameters
    'post_type' => array(                   //(string / array) - tên post type cần lấy bài viết. Mặc định là 'post'
            'post',                         // -  post.
            'page',                         // - page.
            'revision',                     // - revision.
            'attachment',                   // - tập tin đính kèm. 
            'my-post-type',                 // - Tên custom post type
            ),
    'post_type' => 'any',                   // - Lấy bất kỳ post type đang có trên website

//////Status Parameters - Lấy các bài viết dựa theo trạng thái của nó
    //http://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters
    'post_status' => array(                 //(string / array)       
            'publish',                      // - Post hoặc Page đã được publish
            'pending',                      // - Post đang ở trạng thái Pending Review
            'draft',                        // - Post đang trong nháp
            'auto-draft',                   // - Các bài viết tự động lưu nháp
            'future',                       // - Bài viết đang được đặt thời gian đăng trong tương lai
            'private',                      // - Bài viết đang trong trạng thái riêng tư
            'inherit',                      // - Lấy một bản revision
            'trash'                         // - Lấy post từ thùng rác
            ),
    'post_status' => 'any',                 // - Sử dụng bất kỳ trạng thái nào


    
//////Pagination Parameters
    //http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
    'posts_per_page' => 10,                 //(int) - Số lượng bài viết cần lấy ra để hiển thị trên mỗi trang. Nếu muốn hiển thị toàn bộ thì đặt giá trị là -1
    'posts_per_archive_page' => 10,         //(int) - Số lượng bài viết cần lấy ra hiển thị trên mỗi trang. Nhưng chỉ sử dụng cho các trang lưu trữ.
    'nopaging' => false,                    //(bool) - Nếu muốn sử dụng phân trang thì đặt là false. True sẽ hiển thị tất cả post. Mặc định là false.
    'paged' => get_query_var('paged'),      //(int) - Số trang hiện tại.
                                            //NOTE: Sử dụng get_query_var('page') nếu bạn cần sử dụng nó ở một Custom Page Template
    										// http://codex.wordpress.org/Function_Reference/next_posts_link#Usage_when_querying_the_loop_with_WP_Query
                                            // http://codex.wordpress.org/Pagination#Troubleshooting_Broken_Pagination
    'offset' => 3,                          // (int) - Số bài viết trước đó mà bạn muốn bỏ qua.
                                            // Warning: Thiết lập này sẽ làm cho phần phân trang bị lỗi, xem thêm: http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
    										// Nếu tham số 'posts_per_page' có giá trị là -1 thì offset sẽ bị bỏ qua.

                                            
    'page' => get_query_var('page'),        // (int) - Số trang hiện tại sử dụng cho Custom Page Template.
                                            
    'ignore_sticky_posts' => false,         // (boolean) - Tuỳ chọn có lấy bài viết được Sticky hay không. Nếu false thì sẽ hiển thị, true thì bỏ qua.

	//////Order & Orderby Parameters - Thiết lập kiểu sắp xếp các bài viết
    //http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
    'order' => 'DESC',                      //(string) - Thiết lập hiển thị tăng dần hay giảm dần.
                                              //Possible Values:
                                              //'ASC' - Hiển thị kiểu tăng dần (1, 2, 3; a, b, c).
                                              //'DESC' - Hiển thị kiểu giảm dần (3, 2, 1; c, b, a).
    'orderby' => 'date',                    //(string) - Thiết lập loại dữ liệu sẽ được sắp xếp dựa vào. Mặc định nó sẽ là tham số 'date' để dựa vào ngày đăng bài.
                                              //Possible Values:
                                              //'none' - Không sắp xếp
                                              //'ID' - Sắp xếp bởi ID bài viết
                                              //'author' - Sắp xếp bởi tác giả
                                              //'title' - Sắp xếp bởi tiêu đề
                                              //'name' - Sắp xếp bởi slug
                                              //'date' - Sắp xếp bởi ngày tháng
                                              //'modified' - Sắp xếp bởi ngày cập nhật
                                              //'parent' - Sắp xếp bởi ID của page mẹ
                                              //'rand' - Sắp xếp ngaẫu nhiên
                                              //'comment_count' - Sắp xếp bởi số lượng bình luận
                                              //'menu_order' - Sắp xếp bởi thứ tự của trang
                                              //'meta_value' - Sắp xếp bởi giá trị meta data
                                              //'meta_value_num' - Sắp xếp bởi giá trị dạng số tự nhiên của meta data
																							 
//////Date Parameters - Lấy bài viết trong khoảng thời gian cố định
    //http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters

    'date_query' => array(                  //(array) - Date parameters (available with Version 3.7).
                                              //these are super powerful. check out the codex for more comprehensive code examples http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters
      array(
	    'year' => 2014,                         //(int) - năm cần lấy bài (e.g. 2011).
	    'monthnum' => 4,                        //(int) - Tháng cần lấy bài (from 1 to 12).
	    'w' =>  25,                             //(int) - Số tuần trong năm cần lấy bài (từ 0 đến 53).
	    'day' => 17,                            //(int) - Lấy bài dựa theo ngày trong tháng (từ 1 đến 31).
	    'hour' => 13,                           //(int) - Lấy bài dựa theo giờ trong ngày (từ 0 đến 23).
	    'minute' => 19,                         //(int) - Lấy bài dựa theo phút trong giờ (từ 0 đến 60).
	    'second' => 30,                         //(int) - Lấy bài dựa theo giây trong phút (0 đến 60).
	    'm' => 201404,                          //(int) - Tháng của năm cần lấy bài (Ví dụ: 201307).
        'after'     => 'January 1st, 2013', //(string/array) - Lấy bài viết sau ngày cố định. Có thể sử dụng strtotime()-compatible string, hoặc sử dụng array gồm 'year', 'month', 'day'
        'before'    => array(               //(string/array) - Lấy bài viết trước ngày cố định. Có thể sử dụng strtotime()-compatible string, hoặc sử dụng array gồm 'year', 'month', 'day'
          'year'  => 2013,                  
          'month' => 2,                     
          'day'   => 28,                    
        ),
        'inclusive' => true,                //(boolean) - Nếu sử dụng before và after, sử dụng 'true' nếu muốn bao gồm cả hai tham số.
        'compare' =>  '=',                  //(string) - So sánh giá trị với '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='
        'column' => 'post_date',            //(string) - Cột dữ liệu mà cần gửi query đến, mặc định là 'post_date'
        'relation' => 'AND',                //(string) - OR hoặc AND, sử dụng khi có nhiều array trong date_query để tạo mối quan hệ
      ),
    ),

//////Custom Field Parameters - Lấy bài viết dựa theo custom field
    //http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
    'meta_key' => 'key',                    //(string) - Lấy bài dựa theo meta key của custom field
    'meta_value' => 'value',                //(string) - Lấy bài dựa theo giá trị của custom field
    'meta_value_num' => 10,                 //(number) - Giá trị của custom field dạng số tự nhiên
    'meta_compare' => '=',                  //(string) - Toán tử để so sánh với 'meta_value'. Có thể sử dụng '!=', '>', '>=', '<', or ='. Mặc định là '='.
    'meta_query' => array(                  //(array)  - Sử dụng nhiều điều kiện lấy bài viết theo custom field 
       'relation' => 'AND',                 //(string) - Mối quan hệ của các array query bên trong, sử dụng 'OR' hoặc 'AND'
       array(
         'key' => 'color',                  //(string) - Tên meta key
         'value' => 'blue'                  //(string/array) - Giá trị meta value
         'type' => 'CHAR',                  //(string) - Loại giá trị. Có thể sử dụng 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Mặc định là 'CHAR'. Tham số 'type' DATE chỉ có thể hoạt động với tham số 'compare' nếu định dạng ngày tháng được sử dụng là YYYYMMDD.
                                            
         'compare' => '='                   //(string) - Toán tử so sánh với giá trị value trong mảng này. Có thể sử dụng '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
       ),
       array(
         'key' => 'price',
         'value' => array( 1,200 ),
         'compare' => 'NOT LIKE'
       )
    ), 

//////Caching Parameters
    //http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters
    //NOTE Caching is a good thing. Setting these to false is generally not advised.
    'cache_results' => true,                //(bool) Mặc định là true - Lưu cache của thông tin kết quả query
    'update_post_term_cache' => true,       //(bool) Default is true - Post meta information cache.
    'update_post_meta_cache' => true,       //(bool) Default is true - Post term information cache.
    
    'no_found_rows' => false,               //(bool) Xem thêm: http://flavio.tordini.org/speed-up-wordpress-get_posts-and-query_posts-functions
    

//////Search Parameter - Lấy bài viết dựa theo truy vấn tìm kiếm
    //http://codex.wordpress.org/Class_Reference/WP_Query#Search_Parameter
    's' => $s,                              //(string) - Từ khoá tìm kiếm bài viết. $s chính là biến lưu từ khoá truy vấn tìm kiếm khi tìm thông qua form tìm kiếm.
    'exact' => true,                        //(bool) - Tìm nội dung khớp chính xác với từ khoá tìm kiếm
    'sentence' => true,                     //(bool) - Sử dụng tìm kiếm trong cụm từ
         


);

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  // Do Stuff
endwhile;
endif;

// Reset Post Data
wp_reset_postdata();

?>