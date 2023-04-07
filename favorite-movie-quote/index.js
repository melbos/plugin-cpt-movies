import { registerBlockType } from '@wordpress/blocks';
import { serverSideRender } from '@wordpress/editor';

registerBlockType( 'my-plugin/favorite-movie-quote', {
    title: 'Favorite Movie Quote',
    icon: 'format-quote',
    category: 'common',
    attributes: {
        quote: {
            type: 'string',
            source: 'attribute',
            selector: 'p',
            attribute: 'data-quote',
        },
    },
    edit: ( { attributes, setAttributes } ) => {
        const { quote } = attributes;

        return (
            <div>
                <p>Loading quote...</p>
                <serverSideRender
                    block="my-plugin/favorite-movie-quote"
                    attributes={ attributes }
                    onRender={ ( { result } ) => {
                        const { quote } = result;
                        setAttributes( { quote } );
                    } }
                />
            </div>
        );
    },
    save: () => {
        return (
            <p data-quote={ '' }></p>
        );
    },
} );

