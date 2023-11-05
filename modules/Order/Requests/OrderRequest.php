<?php

namespace Modules\Order\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;
use Modules\Order\Models\Order;

class OrderRequest extends FormRequestBase
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$method = segmentUrl(2);

		if($method == 'update') {
			return [
				'name'           => 'required',
				'phone'          => 'required|digits:10',
				'email'          => 'required|email',
				'address'        => 'required',
				'payment_method' => 'required',
			];
		}

		return [
			'name'                      => 'required',
			'phone'                     => 'required|digits:10',
			'email'                     => 'required|email',
			'address'                   => 'required',
			'payment_method'            => 'required',
			'invoice.business.name'     => Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_BUSINESS,
				'name')),
			'invoice.business.email'    => ['email', Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_BUSINESS,
				'email'))],
			'invoice.business.tax_code' => Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_BUSINESS,
				'tax_code')),
			'invoice.business.phone'    => ['digits:10', Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_BUSINESS,
				'phone'))],
			'invoice.business.address'  => Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_BUSINESS,
				'address')),

			'invoice.personal.name'    => Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_PERSONAL,
				'name')),
			'invoice.personal.email'   => ['email', Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_PERSONAL,
				'email'))],
			'invoice.personal.phone'   => ['digits:10', Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_PERSONAL,
				'phone'))],
			'invoice.personal.address' => Rule::requiredIf(fn() => $this->invoiceRequired(Order::INVOICE_PERSONAL,
				'address')),
		];
	}

	public function invoiceRequired($type, $attr)
	{
		if(!empty($this->invoice)) {
			$invoice = $this->invoice;
			if($invoice['type'] == $type && (int) $invoice['status']) {
				return empty($invoice[$type][$attr]);
			} else {
				return false;
			}
		}

		return true;
	}

	public function messages()
	{
		return [
			'required' => ':attribute ' . trans('can not be empty.'),
			'email'    => ':attribute ' . trans('must be a valid email address.'),
			'digits'   => ':attribute ' . trans('must be') . ' :digits ' . trans('digits.'),
		];
	}

	public function attributes()
	{
		return [
			'name'                      => trans('Full Name'),
			'phone'                     => trans('Phone'),
			'address'                   => trans('Address'),
			'email'                     => trans('Email'),
			'payment_method'            => trans('Payment Method'),
			'invoice.business.name'     => trans('Company Name'),
			'invoice.business.email'    => trans('Email'),
			'invoice.business.tax_code' => trans('Tax Code'),
			'invoice.business.phone'    => trans('Phone'),
			'invoice.business.address'  => trans('Registered business address'),
			'invoice.personal.name'     => trans('Name'),
			'invoice.personal.email'    => trans('Email'),
			'invoice.personal.phone'    => trans('Phone'),
			'invoice.personal.address'  => trans('Registered business address'),
		];
	}
}
