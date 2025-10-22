<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataToObjects\ProductDto;
use App\Http\Requests\Admin\AdminProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\RecordNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function __construct(public ProductService $service) {}

    public function index(Request $request): View
    {
        $data = $this->service
            ->fetchData(
                cachePrefix: 'admin'
            )
            ->paginateOnCollection(
                perPage: $this->service->getRecordsLimit(),
                page: $request->query('page', 1)
            );

        return view('admin.products.index', compact('data'));
    }

    public function store(AdminProductRequest $request): RedirectResponse
    {
        $dto = ProductDto::fromRequest($request);
        try {
            $this->service->store($dto);

            return redirect()->back()->with('success', 'Record Created successfully.');
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Failed To Create Record.');
        }
    }

    public function update(AdminProductRequest $request, int $id): RedirectResponse
    {
        $dto = ProductDto::fromRequest($request);
        try {
            /* @var Product $model */
            $model = $this->service->update($id, $dto);

            return redirect()->back()->with('success', "Record {$model->name} Updated Successfully.");
        } catch (RecordNotFoundException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            report($e);

            return redirect()->back()->with('error', 'Failed To Update Record.');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->service->delete($id, 'force');

        return redirect()
            ->back()
            ->with(
                $deleted ? 'success' : 'error',
                $deleted ? 'Record Deleted Successfully.' : 'Failed To Delete Record.'
            );
    }
}
