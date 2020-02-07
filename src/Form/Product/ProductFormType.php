<?php


namespace App\Form\Product;


use App\Entity\Category;
use App\Entity\Product;
use App\Enum\CurrencyProductEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', TextType::class)
			->add('price', NumberType::class)
			->add('currency', ChoiceType::class, [
				'choices' => CurrencyProductEnum::getValues()
			])
			->add('featured', CheckboxType::class)
			->add('category', EntityType::class, [
				'class' => Category::class,
				'multiple' => false
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Product::class,
			'csrf_protection' => false,
		]);
	}

	public function getBlockPrefix()
	{
		return '';
	}
}