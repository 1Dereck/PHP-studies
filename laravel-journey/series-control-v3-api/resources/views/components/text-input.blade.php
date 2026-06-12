@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-100 bg-blue-50/90 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-md px-4 py-3']) }}>
