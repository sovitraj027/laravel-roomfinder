<?php

namespace App\Http\Controllers;

//use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use App\Uploads;
use App\UploadGroups;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function manageUploads($image, $savepath, $gid = "")
    {
        if ($gid == "" || $gid == null || $gid == 0) {
            $maxGroupId = UploadGroups::max('group_id');
            $gid = $maxGroupId + 1;
        } else {
            $gid = $gid;
        }

        $savepathgid = $savepath . '/' . $gid;
        if (!Storage::directories($savepathgid)) {
            Storage::makeDirectory($savepathgid, 0777, true);
        }
        $original_filename = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $upload_size = $image->getClientSize();
        $name = rand(1111111, 9999999) . '.' . $extension;

        Storage::putFileAs($savepathgid, $image, $name);

        $uploadData['filename'] = $name;
        $uploadData['original_filename'] = $original_filename;
        $uploadData['filebasepath'] = $savepath;
        $uploadData['filepath'] = $savepathgid;
        $uploadData['upload_type'] = $extension;
        $uploadData['upload_size'] = $upload_size;
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "PNG" || $extension == "JPG" || $extension == "JPEG" || $extension == "gif" || $extension == "GIF") {
            $uploadData['mime_type'] = "image";
        } else {
            $uploadData['mime_type'] = "doc";
        }

        $upload = Uploads::create($uploadData);

        $uploadGroupData['group_id'] = $gid;
        $uploadGroupData['upload_id'] = $upload->id;

        $uploadgroups = UploadGroups::create($uploadGroupData);

        return $uploadgroups->group_id;

    }

    //deletes previous images takes an instance of model (For E.g. Profile, Notice)
    public function deleteUploads($obj)
    {
        foreach ($obj->upload_groups as $upload_group) {
            Storage::delete($upload_group->upload->filepath . '/' . $upload_group->upload->filename);

            //delete record of previous image
            $upload_group->upload->delete();
            $upload_group->delete();

            //delete directory if empty
            if (!Storage::files($upload_group->upload->filepath)) {
                Storage::deleteDirectory($upload_group->upload->filepath);
            }

        }
        return 1;
    }




}
