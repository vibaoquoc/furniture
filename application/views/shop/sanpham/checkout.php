    <script type="text/javascript" src="<?= URL ?>lib/public/lib/icheck/js/icheck.min.js"></script> 
     <link href="<?= URL ?>lib/public/lib/icheck/skins/flat/red.css" rel="stylesheet">
<?php 
if(isset($this->data['giohang']))
    $giohang=$this->data['giohang'];
else 
    $giohang=array();
$thongtintaikhoan=isset($this->data['taikhoan'])==true?$this->data['taikhoan']:array();

if(!empty($this->data['phivanchuyen']))
{
     function select_phivanchuyen($parent,$menuData,$text=""){
        $html="";
        if(isset($menuData['parent'][$parent])){
            foreach($menuData['parent'][$parent] as $value){
                 if($menuData['items'][$value]['phivanchuyen']==-1 || $menuData['items'][$value]['phivanchuyen']=='')
                {
                $html.="<option disabled value='{$value}'>";
                $html.=$text.$menuData['items'][$value]['ten'];
                $html.="</option>";
                    
                }
                else 
                {
                 $html.="<option value='{$value}'>";
                $html.=$text.$menuData['items'][$value]['ten'];
                $html.=" + ".tien($menuData['items'][$value]['phivanchuyen'])."&#8363;";
                $html.="</option>";
                }
               
                $html.= select_phivanchuyen($value,$menuData,$text."--");
            }
        }
        return $html;
 }
    
   foreach($this->data['phivanchuyen'] as $value){
        $phivanchuyen['items'][$value['id_phivanchuyen']]=$value;//Lưu dữ liệu các biến có id khác nh
        $phivanchuyen['parent'][$value['cha']][]=$value['id_phivanchuyen'];
    }
 $htmlphivanchuyen=  select_phivanchuyen(0,$phivanchuyen);

}
        ?>

                  <?php if(!kiemtradangnhapuser(array(1,2,3,4))){ ?>  <div class="alert alert-info">LÀM ƠN giúp Phong lấy thông tin (tuổi và ng.sinh) của bạn để chạy Datamining<a data-toggle="modal" data-target="#modal_dk_dn"> <b>ĐĂNG NHẬP</b></a></div><?php } ?>

        <!-- page heading-->
  <div class="boxquytrinhhoadon">
      <ul class="quytrinhhoadon" style="    border-bottom: 1px solid #e60a29;">
                <li class="sep1">
                    <a>1</a>
                    <div>Kiểm tra thông tin sản phẩm</div>
                </li>
               <li class="sep2">
                    <a>2</a>
                    <div>Nhập đầy đủ thông tin của bạn</div>
                </li>
               <li class="sep3">
                    <a>3</a>
                      <div>Lập hóa đơn</div>
                </li>
            </ul>
            
            
          
        </div>
        
        <!-- ../page heading-->
        <div class="page-content page-order">
            
            <div class="order-detail-content">
                
                
                <div  style="overflow-x: scroll" class="panel panel-default ">
                    <div class="panel-heading red">Danh sách sản phẩm</div>
                    <div class="panel-body">
                    <table    class="table table-bordered  cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">Sản phẩm</th>
                            <th>Miêu tả</th>
                           
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th  class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody >
                           <?php $tongtien=0; foreach ($giohang as $key=>$value){ ?>
                        
                        <tr>
                            <td class="cart_product">
                                <a href="<?= URL."san-pham/".$value['id_sanpham']."/".$value['slugsanpham'] ?>">
                                <img class="img-responsive" src="<?= URL."public/upload/images/thumb_hinhsanpham/".$value['hinhsanpham'] ?>" alt="p10">
                                </a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name"><a href="<?= URL."san-pham/".$value['id_sanpham']."/".$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?> </a></p>
                               <?php if(kiemtranull($value['masanpham'])){ ?> <small class="cart_ref">Mã SP : <?= $value['masanpham'] ?></small><br><?php } ?>
                               <small><?= $value['tengiatri'] ?></small>
                            </td>
                            <td class="price"><span><?= tien($value['giasanpham']) ?> VND</span>
                                <br>
                                 <small class="cart_ref">Giảm giá : <?= $value['giamgia'] ?>%</small>
                            </td>
                            <td class="qty">
                                <input min="1"  class="form-control input-sm" type="number" value="<?= $value['soluongthem'] ?>">
                                <a class="btn-capnhat" data-key="<?= $key ?>">Cập nhật</a>
                            </td>
                            <td class="price">
                                <span>   <?php 
                                                $tongtiensanpham=$value['giasanpham']*$value['soluongthem'];
                                                 $tiengiamgia=($value['giasanpham']*$value['soluongthem'])*($value['giamgia']/100);
                                                 $tien=$tongtiensanpham-$tiengiamgia;
                                                 echo tien($tien)
                                
                                                 ?> VND</span>
                            </td>
                            <td class="action">
                                <a data-key="<?= $key ?>"  class="checkoutxoasanpham">Delete item</a>
                            </td>
                        </tr>
                        
                           <?php $tongtien+=(int)$tien;} ?>
                        
                        
                    </tbody>
                    <tfoot>
                       
                        <tr>
                            <td colspan="2" rowspan="2"></td>
                            <td colspan="3"><strong>Tổng tiền</strong></td>
                            <td colspan="2"><strong class="tientotal"><?= tien($tongtien) ?> VND</strong></td>
                        </tr>
                    </tfoot>    
                </table> 
                    </div>
                </div>
                
              
                <?php if(!empty($giohang)){ ?>
                <div id="contact" class="page-content page-contact">
            <div id="message-box-conact"></div>
            <form method="POST" class="frmcheckout ">
            <div class="row">
                   
                <div class="col-md-6">
                         <div  class="panel panel-default ">
                    <div class="panel-heading red">Thông tin khách hàng</div>
                    <div class="panel-body">
                     <div class="contact-form-box">
                     
                      
                        <div class="form-selector has-feedback">
                            <label>Tên của bạn</label>
                            <input value='<?= kiemtranull($thongtintaikhoan)==true?$thongtintaikhoan['tentaikhoan']:"" ?>' required="" type="text" class="form-control input-sm" name="tenkhachhang">
                        </div>
                        <div class="form-selector has-feedback">
                            <label>SDT</label>
                            <input value='<?= kiemtranull($thongtintaikhoan)==true?$thongtintaikhoan['sdt']:"" ?>' required="" type="text" class="form-control input-sm" name="sdt">
                        </div>
                             <div class="form-selector has-feedback">
                            <label>Địa chỉ</label>
                            <input value='<?= kiemtranull($thongtintaikhoan)==true?$thongtintaikhoan['diachi']:"" ?>' required="" type="text" class="form-control input-sm" name="diachi">
                        </div>
                             <div class="form-selector">
                            <label>Email</label>
                            <input value='<?= kiemtranull($thongtintaikhoan)==true?$thongtintaikhoan['emaildangnhap']:"" ?>' type="email" class="form-control input-sm" name="email">
                        </div>
                            
                        <div class="form-selector">
                            <label>Ghi chú</label>
                            <textarea class="form-control input-sm" rows="10" name="ghichu"></textarea>
                        </div>
                         
                    </div>
                   
                    </div>
                </div>
                     
                </div>
                      
                <div class="col-md-6">
                    <?php if(isset($htmlphivanchuyen)) { ?>
                    <div  class="panel panel-default ">
                    <div class="panel-heading red">Phí vận chuyển</div>
                    <div class="panel-body">
                     
                            <label class="col-md-4">
                               Giao hàng đến:  
                            </label>
                            <div class="col-md-8">
                                <select name="diadiemgiaohang"  required="" class="diadiemgiaohang form-control" >
                                    <option disabled="" selected="">Chọn địa điểm giao hàng</option>
                                    <?= $htmlphivanchuyen ?>
                                </select>
<script type="text/javascript">
$(document).ready(function() {
  $(".diadiemgiaohang").select2();
});
</script>
                            </div>
                        </div>
                       
                    </div>
                    
                       <div  class="panel panel-default ">
                    <div class="panel-heading red">Phương thức thanh toán</div>
                    <div class="panel-body">
                        <div class="form-selector col-md-12">
                            
                            <div>  <b>Chọn cách bạn sẽ thanh toán</b></div>
                            <hr>
                         <?php foreach ($this->data['hinhthucthanhtoan'] as $key=>$value){ ?>
                            <div class="col-md-4">
                               
                                <input required="" name="hinhthucthanhtoan" type="radio" id="tt<?= $key ?>" value="<?= $key ?>">
                                <label for="tt<?= $key ?>"><?= $value ?></label>
                            </div>
                          
                                  <?php } ?>
                        </div>
                    </div>
                       </div>
                    <?php }?>
                   
              
                    <div class=" col-md-12" id="contact_form_map">
                 <div  class="panel panel-default ">
                    <div class="panel-heading ">Thông tin SHOP</div>
                    <div class="panel-body" id="thongtinshop">
                        <hr>  <h3 class="page-subheading text-center"><i class="fa fa-bookmark icon"  aria-hidden="true"></i> <b><?= TENSHOP ?></b></h3><hr>
                        <p class="thongtinchuyenkhoan"><?=  THONGTINCHUYENKHOAN ?></p>
                    <ul class="store_info">
                        <li><i class="fa fa-home"></i><?= DIACHI ?></li>
                        <li><i class="fa fa-phone"></i><span><?= SDT ?></span></li>
                        <li><i class="fa fa-envelope"></i>Email: <span><?= EMAIL ?></span></li>
                    </ul>                
                    </div>
                        </div>               
                    </div>
                    </div>
                        <div class="col-md-12 text-center"> 
                        <div class="form-selector">
                            <button class="btn-laphoadon animated swing" type="submit">Tạo hóa đơn</button>
                        </div>
                        
                            
               
                        <div class="thongbao alert "><h2>Cảm ơn</h2></div>
                       </div>
   
                </div>
                
                      </form>   
                
                
            </div>
        </div>
                <?php } ?>
                <?php if(!empty($this->data['apriori'])){ ?>
               
                        <div class="page-product-box">
                            <h3 class="heading">Bạn có muốn mua?</h3>
                            <ul class="product-list danhsachsanpham owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                               
                                
                                   <?php foreach ($this->data['apriori'] as $value){ ?>
                        
                         <li>
                          <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                         <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>" class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['tensanpham'] ?>"  alt="<?= $value['tensanpham'] ?>" data-src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"   ></a>
                                    </div>
                                    <div class="add-to-cart">
                                       <?php if(kiemtranull($value['ngangon'])){ ?>
                                        <a> <?= neods($value['ngangon'],120)?></a>
                        <?php }else{} ?>
                                    </div>
                                    <?php
                                        if($value['giamgia']>0){
                                        ?>
                                    <div class="price-percent-reduction2">-<?=$value['giamgia']?>%<br>SAFE</div>
                                    <?php }?>
                                    <div class="group-price">
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                         <span class="product-new">New</span>
                                        <?php }?>                                          
                                      </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                
                                    </h5>
                                   
                                    <div class="content_price">
                                        <?php if($value['gia']!=$value['giamoi']){ ?>
                                        <span class="price product-price"><?= tien($value['giamoi'])?>&nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['gia']) ?></span>
                                        <?php }ELSE{ ?>
                                         <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                        <?php } ?>
                                    </div>
                                   
                                </div>
                            </div>
                        </li>
                        <?php }?>
                                
                                
                            </ul>
                        </div>
                        <?php } ?>
                <div class="cart_navigation">
                    <a class="prev-btn" href="<?= URL ?>">Tiếp tục mua hàng</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= URL ?>view/<?= THEME ?>/sanpham/js/checkout.js"> </script>

<script>
datagiohang= JSON.parse(JSON.stringify(<?= json_encode($giohang) ?>));
</script>