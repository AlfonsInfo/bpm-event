<?php

namespace App\Http\Controllers\api;

use App\Exceptions\DataNotFoundException;
use App\Helper\RequestQueryMapper;
use App\Helper\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupCellHasMemberRequest;
use App\Http\Requests\PaginatedRequest;
use App\Models\GroupCell;
use App\Models\GroupCellHasMember;

class GroupCellHasMemberController extends Controller
{
    protected $groupCellController;

    public function __construct(GroupCellController $groupCellController)
    {
        $this->groupCellController = $groupCellController;
    }

    public function get(PaginatedRequest $request, int $groupCellId)
    {
   
        $groupCell = $this->groupCellController->validateGetModelById($groupCellId);
        $query = $groupCell->members()->getQuery(); // misalnya relasi ke anggota (users)
        RequestQueryMapper::search($request,$query,"name");
        return RequestQueryMapper::paginate($request,$query);
    }
    
    public function post(GroupCellHasMemberRequest $request, int $groupCellId)
    {
        $groupCell = $this->groupCellController->validateGetModelById($groupCellId);
        $userIds = $request->input('user_ids');
        $groupCell->members()->syncWithoutDetaching($userIds);
        return ResponseBuilder::responseCreated();
    }

    public function delete($id)
    {
        $model = self::validateGetModelById($id);
        $model->delete();
        return ResponseBuilder::responseDeleted();
    }

    public function validateGetModelById(int $id){
            return GroupCellHasMember::where('id', $id)->first() ?? throw new DataNotFoundException();
    }


}
