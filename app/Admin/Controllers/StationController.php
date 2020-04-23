<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Station;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Area;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class StationController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '測站';

   public function index(Content $content)
   {
      return $content
         ->header('測站')
         ->description('管理')
         ->body($this->grid());
   }

   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new Station());

      $grid->column('id', __('Id'));
      $grid->column('area.area_name', __('地區'));
      $grid->column('station_code', __('測站代號'));
      $grid->column('station_name', __('測站'));
      $grid->column('telno', __('電話'));
      $grid->column('order', __('排序'));
      $grid->column('valid_at', __('有效日期'));
      $grid->column('mod_user', __('異動人員'));
      $grid->column('updated_at', __('異動時間'));

      return $grid;
   }

   /**
    * Make a show builder.
    *
    * @param mixed $id
    * @return Show
    */
   protected function detail($id)
   {
      $show = new Show(Station::findOrFail($id));

      $show->field('id', __('Id'));

      //ref https://github.com/z-song/laravel-admin/issues/3107
      $show->area_id('地區名稱')->as(function ($area_id) {
         return Area::where('id', $area_id)->first()->area_name ?? null;
      });

      $show->field('station_code', __('測站代號'));
      $show->field('station_name', __('測站名稱'));
      $show->field('address', __('地址'));
      $show->field('telno', __('電話'));
      $show->field('remark', __('備註'));
      $show->field('footer', __('網站資訊footer'))->unescape();
      $show->field('order', __('排序'));
      $show->field('valid_at', __('有效日期'));
      $show->field('mod_user', __('異動人員'));
      $show->field('created_at', __('建立時間'));
      $show->field('updated_at', __('異動時間'));

      return $show;
   }

   /**
    * Make a form builder.
    *
    * @return Form
    */
   protected function form()
   {
      $form = new Form(new Station());

      $form->select('area_id', __('地區名稱'))->options(Area::all()->pluck('area_name', 'id'))->rules('required');
      $form->text('station_code', __('測站代號'))->rules('required|max:4');
      $form->text('station_name', __('測站名稱'))->rules('required|max:40');
      $form->text('address', __('地址'));
      $form->text('telno', __('電話'));
      $form->ckeditor('footer', __('網站資訊footer'));
      $form->text('order', __('排序'));
      $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
      $form->textarea('remark', __('備註'));
      $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
