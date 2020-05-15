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
         ->breadcrumb(['text' => '測站管理'])
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
      $grid->column('area.area_name', __(trans('admin.area_name')));
      $grid->column('station_code', __(trans('admin.station_code')));
      $grid->column('station_name', __(trans('admin.station_name')));
      $grid->column('telno', __(trans('admin.telno')));
      $grid->column('order', __(trans('admin.order')));
      $grid->column('valid_at', __(trans('admin.valid_at')));
      $grid->column('mod_user', __(trans('admin.mod_user')));
      $grid->column('updated_at', __(trans('admin.updated_at')));

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
      $show->area_id(trans('admin.area_name'))->as(function ($area_id) {
         return Area::where('id', $area_id)->first()->area_name ?? null;
      });

      $show->field('station_code', __(trans('admin.station_code')));
      $show->field('station_name', __(trans('admin.station_name')));
      $show->field('address', __(trans('admin.address')));
      $show->field('telno', __(trans('admin.telno')));
      $show->field('remark', __(trans('admin.remark')));
      $show->field('footer', __(trans('admin.footer')))->unescape();
      $show->field('order', __(trans('admin.order')));
      $show->field('valid_at', __(trans('admin.valid_at')));
      $show->field('mod_user', __(trans('admin.mod_user')));
      $show->field('created_at', __(trans('admin.created_at')));
      $show->field('updated_at', __(trans('admin.updated_at')));

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

      $form->select('area_id', __(trans('admin.area_name')))->options(Area::all()->pluck('area_name', 'id'))->rules('required');
      $form->text('station_code', __(trans('admin.station_code')))->rules('required|max:4');
      $form->text('station_name', __(trans('admin.station_name')))->rules('required|max:40');
      $form->text('address', __(trans('admin.address')));
      $form->text('telno', __(trans('admin.telno')));
      $form->ckeditor('footer', __(trans('admin.footer')));
      $form->text('order', __(trans('admin.order')));
      $form->datetime('valid_at', __(trans('admin.valid_at')))->default(date('Y-m-d H:i:s'));
      $form->textarea('remark', __(trans('admin.remark')));
      $form->text('mod_user', __(trans('admin.mod_user')))->default(Admin::user()->name)->readonly();
      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
