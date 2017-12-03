# Changelog

## [Unreleased]
### Changed
- Changelog format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/).
- Minimum requirement is PHP 7.2.
- PHPUnit version 6.* required.

### Removed
- Dev dependency on the QualityCheck library.
- No more `@package ElementTree` in dockblocks.


## older versions

*   0.8.1

    *   Fix possible autoload problems with composer.

*   0.8.0

    *   Changed project directory structure, moving to PSR4.
    *   Added PhpUnit xml configuration.
    *   Added QualityCheck library tools.
    *   Fix PSR2 coding violations.

*	0.7.1

	*	Bug fixes for replacing components.

*	0.7.0

	*	Only `ElementTree` has utility method for creating query. Other
		components don't implement `Queryable` anymore and this interface
		is removed.
	*	Added `Component::getNextSibling` and `Component::getPreviousSibling`.
	*	Added `Composable::insertAfter` and `Composable::insertBefore`.
	*	Removed option to append after other component. One can use `insertAfter`
		for that.

*	0.6.0

	*	OwnerTrees are only OwnerTrees of components when they are added,
		not upon creation or after removal (another difference with DOM).

*	0.5.0

	*	`ElementTreeAttribute` is not `Appendable`.

*	0.4.0

	*	Introduced interface `Appendable`. An `ElementTree` object is not appendable.
		`ElementTreeElement`, `ElementTreeText`, `ElementTreeComment`,
		`ElementTreeAttribute` are appendable (to a `Composable`). 

*	0.3.6

	*	Changed copyright to Koen Hoeymans.
	*	Added `Element::hasAttribute($name)`.

*	0.3.5

	*	Another bugfix.

*	0.3.4

	*	Bugfixes.

*	0.3.3

	*	Removes elements anywhere in the subtree.

*	0.3.2

	*	Added `Element::removeAttribute`.

*	0.3.1

	*	Abstracted querying and creating query objects behind an interface.

*	0.3.0

	*	Changed querying explicit to specification instead of filters.
	*	Querying now returns a list of matching components instead of using
		callbacks.

*	0.2.2

	*	Attributes are included in queries.
	*	FilterBuilder can make use of `allAttributes`.

*	0.2.1

	*	`Element` provides a list of attributes.

*	0.2.0

	*	Text doesn't stringify using htmlentities anymore but uses the raw value.

*	0.1.5

	*	Introduces attributes as objects.
	*	Values of attributes can be singe/double/unquoted when stringified.

*	0.1.4

	*	`HasParentElement` does not need to specify a name to select any parent element.
	*	Created not-filter for inverse of containing filter.

*	0.1.3

	*	Composite specifications now accept a `FilterBuilder` which provides a
		more fluent interface (otherwise they would need a `new` specification).

*	0.1.2

	*	AndSpecification added (combines filters).
	*	HasParent($name) specificationadded.

*	0.1.1

	*	Added filter that searches all `Element` components.

*	0.1.0

	*	Initial release.